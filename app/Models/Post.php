<?php
namespace App\Models;

use Core\Model;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Model
{
    const POST_STATUS_PENDING = 0;
    const POST_STATUS_PUBLISHED = 1;
    const POST_STATUS_SPAM = 2;

    protected $table = 'posts';

    protected $fillable = ['id', 'title', 'description', 'status', 'created_by'];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
