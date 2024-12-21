<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investments = Investment::all();
        return view('investments.index', compact('investments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('investments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'investor_id' => 'required|numeric',
            'investment_date' => 'required|date',
            'duration_months' => 'required|integer',
            'rate_of_return' => 'required|numeric',
        ]);

        Investment::create($request->all());

        return redirect()->route('investments.index')->with('success', 'Investment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        return view('investments.show', compact('investment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investment $investment)
    {
        return view('investments.edit', compact('investment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investment $investment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'investor_id' => 'required|numeric',
            'investment_date' => 'required|date',
            'duration_months' => 'required|integer',
            'rate_of_return' => 'required|numeric',
        ]);

        $investment->update($request->all());

        return redirect()->route('investments.index')->with('success', 'Investment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investment $investment)
    {
        $investment->delete();

        return redirect()->route('investments.index')->with('success', 'Investment deleted successfully.');
    }
}
