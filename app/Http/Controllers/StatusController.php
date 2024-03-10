<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class StatusController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string', // You might want to add validation rules for color format
        ]);

        TaskStatus::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'), // Default color if not provided
        ]);

        return redirect()->route('dashboard')->with('success', 'Task status created successfully.');
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
    public function destroy(Request $request)
    {

        $request->validate([
            'status_id' => 'required|exists:task_statuses,id',
        ]);

        $status = TaskStatus::findOrFail($request->input('status_id'));
        $status->delete();

        return redirect()->route('dashboard')->with('success', 'Task status deleted successfully.');
    }
}
