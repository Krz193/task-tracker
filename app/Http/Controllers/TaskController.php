<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('form_task', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $project->tasks()->create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => TaskStatus::TODO,
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('project.index', $project->id)->with('success', 'Task added successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $task->update($request->all());

        return redirect()->route('project.show', $task->project_id)->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_column(TaskStatus::cases(), 'value'))
        ]);

        $task->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully!']);
    }
}
