<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\UserAccess;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    public function index()
    {
        $users = User::with('accesses.program')->get();
        $programs = Program::all();
        return view('user-access.index', compact('users', 'programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'program_id' => 'required|exists:programs,id',
            'can_access' => 'required|boolean',
        ]);

        UserAccess::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'program_id' => $request->program_id,
            ],
            ['can_access' => $request->can_access]
        );

        return redirect()->route('user-access.index')->with('success', 'Access updated successfully.');
    }
}
