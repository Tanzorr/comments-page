<?php

namespace App\Http\Controllers;

use App\Actions\StoreCommentAction;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentCollection;
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
    public function index(Request $request): void
    {
        $comments = Comment::sortRootComments(
            $request->get('sort_by', 'created_at'),
            $request->get('sort_direction', 'asc')
        )->paginate(25);

        echo (new CommentCollection($comments))->toJson();
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
    public function store(StoreCommentAction $action): \Illuminate\Http\JsonResponse

    {
        $action->handle();

        return response()->json(['message' => 'Comment saved successfully'], 200);
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
