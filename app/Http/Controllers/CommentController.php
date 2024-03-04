<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\ImageService;

class CommentController extends Controller
{
    private string $storagePath = 'app/public/files';
    public function __construct(public ImageService $imageService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "Hello comments";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Comment $comment): void
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file'] = $this->imageService->saveImage($file, $this->storagePath);
        }

        $comment->fill($data);
        $comment->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
