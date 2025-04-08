<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === UserRole::ADMIN;

        // dd(Task::whereHas('project', fn($q) => 
        //     $q->where('user_id', $user->id)
        // )->toSql());


        $array = [];

        if($isAdmin) {
            $array = [
                'isAdmin' => true,
                'totalUsers' => User::count(),
                'totalProjects' => Project::count(),
                'totalTasks' => Task::count(),

                // User dengan project terbanyak
                'topProjectUser' => User::withCount('projects as topProjects')
                ->orderByDesc('topProjects')
                ->first(),
                
                // User dengan task DONE terbanyak
                'topTaskDoneUser' => Project::with(['user'])
                ->withCount(['tasks as tasks_done' => fn($q) =>
                    $q->where('tasks.status', TaskStatus::DONE->value)
                ])
                ->orderByDesc('tasks_done')
                ->first(),
            ];
        } else {
            $array = [
                'isAdmin' => false,
                'totalProjects' => Project::where('user_id', $user->id)->count(),
                'totalTasks' => Task::with('project')
                ->whereHas('project', function ($q)use ($user) { 
                    $q->where('user_id', $user->id);
                })->count(),
            ];
        }

        $data = json_decode(json_encode($array));

        return view('dashboard', compact('data'));
    }
}
