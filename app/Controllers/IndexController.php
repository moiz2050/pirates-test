<?php
namespace App\Controllers;

use App\Models\Post;
use Core\Controller;

/**
 * Class IndexController
 * @package App\Controllers
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $publishedPosts = Post::where('status', Post::POST_STATUS_PUBLISHED)->get();
        $this->loadView('index', ['posts' => $publishedPosts]);
    }
}
