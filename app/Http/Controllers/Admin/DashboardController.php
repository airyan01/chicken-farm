<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chicken;
use App\Models\CareLog;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with summary stats and chickens overview.
     */
    public function dashboard()
    {
        $totalChickens = Chicken::count();
        
        $totalEggsToday = CareLog::whereDate('date', now()->toDateString())
            ->sum('eggs_collected');

        // Chickens whose latest recorded health status is NOT 'Healthy'
        $chickensNeedingAttention = Chicken::whereHas('latestCareLog', function ($query) {
            $query->where('health_status', '!=', 'Healthy');
        })->count();

        $activeCaretakers = User::where('role', 'caretaker')->count();

        // Get chickens with their caretaker, latest care log, and today's care log
        $chickens = Chicken::with([
            'caretaker',
            'latestCareLog',
            'careLogs' => function ($query) {
                $query->whereDate('date', now()->toDateString());
            }
        ])->latest()->get();

        return view('admin.dashboard', compact(
            'totalChickens',
            'totalEggsToday',
            'chickensNeedingAttention',
            'activeCaretakers',
            'chickens'
        ));
    }

    /**
     * View history log of daily care entries.
     */
    public function history(Request $request)
    {
        $chickensList = Chicken::orderBy('name')->get();

        $query = CareLog::with(['chicken', 'user']);

        // Filter by Chicken
        if ($request->filled('chicken_id')) {
            $query->where('chicken_id', $request->chicken_id);
        }

        // Filter by Start Date
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        // Filter by End Date
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $logs = $query->latest('date')->latest('created_at')->get();

        return view('admin.history', compact('chickensList', 'logs'));
    }
}
