<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investors = Investor::all();
        return view('investors.index', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('investors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Investor::create($request->all());

        return redirect()->route('investors.index')->with('success', 'Investor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Investor $investor)
    {
        return view('investors.show', compact('investor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investor $investor)
    {
        return view('investors.edit', compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investor $investor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors,email,' . $investor->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $investor->update($request->all());

        return redirect()->route('investors.index')->with('success', 'Investor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investor $investor)
    {
        $investor->delete();

        return redirect()->route('investors.index')->with('success', 'Investor deleted successfully.');
    }
}
