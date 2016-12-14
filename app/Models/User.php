<?php
namespace App\Models;

use Core\Model;

/**
 * Class UsersModel
 * @package App\Models
 */
class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['id', 'email', 'is_moderator'];

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by');
    }
}
