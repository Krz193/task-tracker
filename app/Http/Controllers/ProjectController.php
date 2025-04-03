<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('dashboard', compact('projects'));
    }

    public function find($id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        return view('project', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('form_project', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('project.index', $project->id)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
}
