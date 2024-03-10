<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Requests\TaskPostRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tasks::with('status:id,name,color');

        if(!auth()->user()->isAdmin()){
            $query->where('user_id', auth()->user()->id);
        }

        if ($request->filled('status')) {
            $query->filterByStatus($request->status);
        }

        // Apply due date filter if selected
        if ($request->filled('due_date')) {
            $query->filterByDueDate($request->due_date);
         }

        $tasks = $query->paginate(10);

        $task_statuses = TaskStatus::get();

        return view('tasks.index', ['tasks' => $tasks, 'statuses' => $task_statuses]);
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
    public function store(TaskPostRequest $request)
    {

        // Create a new task instance
        $task = new Tasks();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->duedate = $request->input('duedate');

        // Set the status if provided
        if ($request->has('status')) {
            $task->task_status_id = $request->input('status');
        }

        // Associate the task with the authenticated user
        $task->user_id = auth()->id();

        // Save the task to the database
        $task->save();

        // Redirect to a route or view
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $task)
    {
        $this->authorize('update', $task);
        $task_statuses = TaskStatus::get();
        return view('tasks.edit', ['task' => $task, 'statuses' => $task_statuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskPostRequest $request, Tasks $task)
    {

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->duedate = $request->input('duedate');

        if ($request->has('status')) {
            $task->task_status_id = $request->input('status');
        }

        $task->save();

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        // Delete the task

        $task->comments()->delete();

        $task->delete();

        // Redirect to a route or view
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
