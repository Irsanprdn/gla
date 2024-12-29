<?php 
namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // Display a listing of the programs
    public function index()
    {
        $programs = Program::leftJoin('programs as parent', function ($join) {
            $join->on('programs.parent_id', '=', 'parent.id')
                 ->where('parent.type', '=', 'parent'); // Asumsi tipe parent
        })
        ->select('programs.*', 'parent.name as parent_name')
        ->orderByRaw('COALESCE(programs.parent_id, programs.id)')
        ->orderByRaw('CASE WHEN programs.parent_id IS NULL THEN 0 ELSE 1 END')
        ->orderBy('programs.id')
        ->get();

        return view('programs.index', compact('programs'));
    }

    // Show the form for creating a new program
    public function create()
    {
        return view('programs.create');
    }

    // Store a newly created program in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:programs,id',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:parent,child',
        ]);

        Program::create($request->all());

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    // Display the specified program
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    // Show the form for editing the specified program
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    // Update the specified program in the database
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:programs,id',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:parent,child',
        ]);

        $program->update($request->all());

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    // Remove the specified program from the database
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
