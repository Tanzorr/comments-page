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
        'file_path',
        'text',
        'parent_comment_id',
    ];
}
