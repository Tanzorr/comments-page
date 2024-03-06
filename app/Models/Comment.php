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


    public function subcomments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_comment_id')->with('subcomments');
    }

    public function parentComment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_comment_id');
    }

    public static function getAllRootComments(): \Illuminate\Database\Eloquent\Builder
    {
        return static::with('subcomments')->whereNull('parent_comment_id')->orderBy('id');
    }

    public static function getCommentsWithSubComments($parentCommentId): Collection|array
    {
        return static::with('subcomments')->where('parent_comment_id', $parentCommentId)->get();
    }


}
