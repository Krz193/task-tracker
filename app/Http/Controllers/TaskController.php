<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TaskController
 *
 * Controller untuk mengelola tugas (tasks) dalam sebuah proyek.
 */
class TaskController extends Controller
{
    /**
     * Menampilkan form untuk membuat task baru dalam sebuah proyek.
     *
     * @param  Project  $project
     * @return \Illuminate\View\View
     */
    public function create(Project $project)
    {
        return view('form_task', compact('project'));
    }

    /**
     * Menyimpan task baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->tasks()->create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => TaskStatus::TODO,
        ]);

        return redirect()->route('project.index', $project->id)->with('success', 'Task added successfully.');
    }

    /**
     * Menampilkan form edit untuk task yang dipilih.
     *
     * @param  Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Memperbarui data task yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Menghapus task dari database.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }

    /**
     * Memperbarui status dari sebuah task tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Validasi status yang diterima harus sesuai dengan TaskStatus enum
        $request->validate([
            'status' => 'required|in:' . implode(',', array_column(TaskStatus::cases(), 'value'))
        ]);

        // Memperbarui status task
        $task->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status updated successfully!',
            'status' => $task->status,
        ]);
    }
}
