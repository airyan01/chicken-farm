<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chicken;
use App\Models\User;

class ChickenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chickens = Chicken::with('caretaker')->latest()->get();
        return view('admin.chickens.index', compact('chickens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caretakers = User::where('role', 'caretaker')->get();
        return view('admin.chickens.create', compact('caretakers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'acquired_at' => 'required|date',
            'caretaker_id' => 'nullable|exists:users,id',
        ]);

        Chicken::create($validated);

        return redirect()->route('admin.chickens.index')->with('success', 'Chicken added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chicken $chicken)
    {
        $caretakers = User::where('role', 'caretaker')->get();
        return view('admin.chickens.edit', compact('chicken', 'caretakers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chicken $chicken)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'acquired_at' => 'required|date',
            'caretaker_id' => 'nullable|exists:users,id',
        ]);

        $chicken->update($validated);

        return redirect()->route('admin.chickens.index')->with('success', 'Chicken updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chicken $chicken)
    {
        $chicken->delete();

        return redirect()->route('admin.chickens.index')->with('success', 'Chicken removed successfully!');
    }
}
