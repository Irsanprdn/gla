<?php
namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $income = Income::all();
        return view('income.index', compact('income'));
    }

    public function create()
    {
        return view('income.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_income' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        Income::create($validated);

        return redirect()->route('income.index')->with('success', 'Data income berhasil ditambahkan.');
    }

    // Tambahkan metode lainnya (show, edit, update, destroy) sesuai kebutuhan.
}
