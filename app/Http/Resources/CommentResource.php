<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user_name'=>$this->user_name,
            'email'=>$this->email,
            'text'=>$this->text,
            'file_path'=>$this->file_path,
            'created_at'=>$this->created_at,
            'parent_comment_id'=>$this->parent_comment_id,
            'sub_comments'=> Comment::getCommentsWithSubComments($this->id)

        ];
    }
}
