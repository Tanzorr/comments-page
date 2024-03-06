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


    // Відношення до дочірніх коментарів
    public function subcomments()
    {
        return $this->hasMany(self::class, 'parent_comment_id')->with('subcomments');
    }

    // Відношення до батьківського коментаря
    public function parentComment()
    {
        return $this->belongsTo(self::class, 'parent_comment_id');
    }

    // Отримати всі кореневі коментарі
    public static function getAllRootComments()
    {
        return static::with('subcomments')->whereNull('parent_comment_id')->orderBy('id')->get();
    }

    // Отримати коментарі з вказаним parent_comment_id та їхні субкоментарі
    public static function getCommentsWithSubComments($parentCommentId): Collection|array
    {
        return static::with('subcomments')->where('parent_comment_id', $parentCommentId)->get();
    }


}
