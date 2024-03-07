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


    /**
     * Scope a query to sort root comments by user_name, email, and created_at.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $column
     * @param  string  $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortRootComments($query, $column = 'created_at', $direction = 'asc')
    {
        return $query->whereNull('parent_comment_id') // Only root comments
        ->orderBy($column, $direction)
            ->orderBy('user_name') // You can add more columns for sorting
            ->orderBy('email');
    }

    public static function getCommentsWithSubComments($parentCommentId): Collection|array
    {
        return static::with('subcomments')->where('parent_comment_id', $parentCommentId)->get();
    }


}
