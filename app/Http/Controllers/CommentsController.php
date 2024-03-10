<?php

namespace App\Http\Controllers;

use App\Events\CommentMade;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\Tasks;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Tasks $task)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $comment = new Comments();
        $comment->description = $request->input('description');
        $comment->tasks_id = $task->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        if($task->user_id !== auth()->user()->id)
        event(new CommentMade($comment, $task));

        return redirect()->route('tasks.show', $task);
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
