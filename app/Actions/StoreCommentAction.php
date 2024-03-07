<?php

namespace App\Actions;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\ImageService;

class StoreCommentAction
{
    private ImageService $imageService;
    private Comment $comment;
    private CommentRequest $request;
    private string $storagePath = 'app/public/files';

    public function __construct(
        ImageService $imageService,
        Comment $comment,
        CommentRequest $request
    )
    {
        $this->imageService = $imageService;
        $this->comment = $comment;
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->validated();

        if ($this->request->hasFile('file')) {
            $file = $this->request->file('file');
            $data['file_path'] = $this->imageService->saveImage($file, $this->storagePath);
        }

        $this->comment->fill($data);
        $this->comment->save();
    }
}
