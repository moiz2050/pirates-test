<?php
namespace App\Controllers;

use App\Events\NewJobPostedForModerationEvent;
use App\Models\Post;
use App\Models\User;
use Core\Controller;
use Core\Crypt;
use Core\Helper;
use Illuminate\Database\Capsule\Manager;

/**
 * Class PostController
 * @package App\Controllers
 */
class PostController extends Controller
{

    public function create()
    {
        $data = ['title'=> 'Create Job Post'];
        $this->loadView('post/create', $data);
    }


    public function post()
    {
        $validator = $this->validator();
        $_POST = $validator->sanitize($_POST);
        $data = $_POST;

        $validationRules = [
            'email' => 'required|valid_email',
            'title' => 'required',
            'description' => 'required'
        ];

        $validation = $validator->validate($data, $validationRules);

        if (is_array($validation) && count($validation) > 0) {
            $this->loadView('post/create', ["errors" => $validator->get_errors_array()]);
        }

        $user = User::where('email', $data['email'])->first();

        $postAutoPublished = true;

        Manager::beginTransaction();
        
        if (!$user) {
            $user = User::create([
                'email' => $data['email']
            ]);
            $postAutoPublished = false;
        }

        $checkIfUnPublishedPostExist = $user->posts()->where('status', Post::POST_STATUS_PENDING)->get();

        if (count($checkIfUnPublishedPostExist) > 0) {
            $this->loadView(
                'post/create',
                ["errors" => ["you already have un published post wait until it got verified"]]
            );
            return;
        }

        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => ($postAutoPublished)?Post::POST_STATUS_PUBLISHED:Post::POST_STATUS_PENDING,
            'created_by' => $user->id
        ]);

        Manager::commit();

        if (!$postAutoPublished) {
            $moderator = User::where('is_moderator', 1)->first();
            Helper::fire(new NewJobPostedForModerationEvent($moderator->email, $user->email, $post));
        }

        $this->redirect(Helper::makeUrl('post/show/'.$post->id));
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            throw new \Exception('post not found');
        }

        $title = $post->title;
        $this->loadView('post/show', ["post" => $post, "title" => $title]);
    }

    /**
     * @param $token
     * @param $id
     * @throws \Exception
     */
    public function markPublish($token, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            throw new \Exception('job post not found');
        }

        $moderatorEmail = Crypt::decrypt($token);

        $moderator = User::where('email', $moderatorEmail)->where('is_moderator', 1)->first();


        if (!$moderator) {
            throw new \Exception('Moderator not valid');
        }

        $post->status = Post::POST_STATUS_PUBLISHED;
        $post->save();

        $this->loadView('post/show', ["post" => $post, "title" => $post->title]);
    }

    /**
     * @param $token
     * @param $id
     * @throws \Exception
     */
    public function markSpam($token, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            throw new \Exception('job post not found');
        }

        $moderatorEmail = Crypt::decrypt($token);

        $moderator = User::where('email', $moderatorEmail)->where('is_moderator', 1)->first();


        if (!$moderator) {
            throw new \Exception('Moderator not valid');
        }

        $post->status = Post::POST_STATUS_SPAM;
        $post->save();

        $this->loadView('post/show', ["post" => $post, "title" => $post->title]);
    }
}
