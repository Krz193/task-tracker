<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\QuoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        // cek apakah yang login adalah admin
        $user = Auth::user();
        $isAdmin = $user->role === UserRole::ADMIN;

        // ambil total task dari semua project user yang login
        $totalTask = Task::whereHas('project', fn($q) => 
        $q->where('user_id', '=', Auth::id()))
        ->count();

        // ambil total task yang berstatus 'done' dari semua project
        $totalDoneTasks = Task::whereHas('project', fn($q) => 
        $q->where('user_id', '=', Auth::id())
        ->where('status', '=', TaskStatus::DONE))
        ->count();

        // hitung persentase task yang dikerjakan user yang login
        $tasksPercentage = ($totalTask !== 0) 
        ? round(($totalDoneTasks/$totalTask) * 100, 2)
        : 0;

        // ambil quote sesuai persentase
        $quote = QuoteService::getQuote($tasksPercentage);

        // deklarasi array kosong untuk store data
        $array = [];

        // cek kondisi role user yang login
        if($isAdmin) {

            /**
             * jika admin isi dengan data yang diperlukan di 
             * dashboard admin
            */
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

            /**
             * jika bukan admin isi dengan data yang diperlukan di 
             * dashboard user
            */
            $array = [
                'isAdmin' => false,
                'totalProjects' => Project::where('user_id', '=', Auth::id())
                ->count(),
                'topProject' => Project::with(['tasks' => function($q) {
                    $q->where('status', 'done');
                }])
                ->withCount(['tasks as tasks_done' => function($q) {
                    $q->where('status', 'done');
                }])
                ->where('user_id', '=', Auth::id())
                ->orderByDesc('tasks_done')
                ->first(),
                'totalTasks' => $totalTask,
                'totalDoneTasks' => $totalDoneTasks,
                'tasksPercentage' => $tasksPercentage,
                'quote' => $quote,
            ];
        }

        // dd($array);

        /**
         * jadikan json object semua nested array,
         * lalu kembalikan ke array semua json object sampai nested json nya
         */
        $data = json_decode(json_encode($array));

        return view('dashboard', compact('data'));
    }
}
