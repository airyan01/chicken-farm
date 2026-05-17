<?php

namespace App\Http\Controllers\Caretaker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chicken;
use App\Models\CareLog;

class CareController extends Controller
{
    /**
     * Display the caretaker's dashboard with assigned chickens.
     */
    public function dashboard(Request $request)
    {
        $chickens = Chicken::where('caretaker_id', $request->user()->id)
            ->with(['careLogs' => function ($query) {
                $query->whereDate('date', now()->toDateString());
            }])
            ->get();

        return view('caretaker.dashboard', compact('chickens'));
    }

    /**
     * Show the form to record today's care log for a specific chicken.
     */
    public function create(Request $request, Chicken $chicken)
    {
        // Security check: Ensure chicken is assigned to this caretaker
        if ($chicken->caretaker_id !== $request->user()->id) {
            abort(403, 'Unauthorized. This chicken is not assigned to you.');
        }

        // Check if today's log already exists
        $existingLog = $chicken->careLogs()
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($existingLog) {
            return redirect()->route('caretaker.dashboard')
                ->with('error', 'Today\'s care log has already been recorded for this chicken!');
        }

        return view('caretaker.create', compact('chicken'));
    }

    /**
     * Store today's care log.
     */
    public function store(Request $request, Chicken $chicken)
    {
        // Security check
        if ($chicken->caretaker_id !== $request->user()->id) {
            abort(403, 'Unauthorized.');
        }

        // Check if today's log already exists
        $existingLog = $chicken->careLogs()
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($existingLog) {
            return redirect()->route('caretaker.dashboard')
                ->with('error', 'Today\'s care log has already been recorded for this chicken!');
        }

        // Validation
        $request->validate([
            'feed_type' => 'required|string|max:255',
            'feed_quantity' => 'required|string|max:255',
            'feed_time' => 'required',
            'health_status' => 'required|string|in:Healthy,Sick,Injured,Under Observation',
            'health_symptoms' => 'nullable|string',
            'eggs_collected' => 'required|integer|min:0',
        ]);

        // Create log
        CareLog::create([
            'chicken_id' => $chicken->id,
            'user_id' => $request->user()->id,
            'date' => now()->toDateString(),
            'feed_type' => $request->feed_type,
            'feed_quantity' => $request->feed_quantity,
            'feed_time' => $request->feed_time,
            'health_status' => $request->health_status,
            'health_symptoms' => $request->health_symptoms,
            'eggs_collected' => $request->eggs_collected,
        ]);

        return redirect()->route('caretaker.dashboard')
            ->with('success', 'Daily care log recorded successfully!');
    }

    /**
     * Show today's care log.
     */
    public function show(Request $request, Chicken $chicken)
    {
        // Security check
        if ($chicken->caretaker_id !== $request->user()->id) {
            abort(403, 'Unauthorized.');
        }

        $log = $chicken->careLogs()
            ->whereDate('date', now()->toDateString())
            ->firstOrFail();

        return view('caretaker.show', compact('chicken', 'log'));
    }
}
