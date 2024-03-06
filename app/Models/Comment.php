<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Builder as QueryBuildr;

class Comment extends Model
{
    use HasFactory;

   protected $fillable = [
        'user_name',
        'email',
        'home_page',
        'file',
        'text',
        'parent_comment_id',
    ];

    // Визначте відносину для дочірніх коментарів
//    public function replies()
//    {
//        return $this->hasMany(Comment::class, 'parent_comment_id')->with('replies');
//    }
}
