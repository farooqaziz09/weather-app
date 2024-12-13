<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending',
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        return view('task-view', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);

        return view('task-edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = ['title' => $request->title, 'description' => $request->description];
        Task::find($id)->update($data);
        return redirect()->back()->with(['message' => 'Task updated']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();
        return redirect()->back()->with(['message' => 'Weather Task Deleted']);
    }
}
