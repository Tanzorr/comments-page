<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
