<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expense = Expense::all();
        return view('expense.index', compact('expense'));
    }

    public function create()
    {
        return view('expense.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_expense' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        Expense::create($validated);

        return redirect()->route('expense.index')->with('success', 'Data expense berhasil ditambahkan.');
    }

    // Tambahkan metode lainnya (show, edit, update, destroy) sesuai kebutuhan.
}
