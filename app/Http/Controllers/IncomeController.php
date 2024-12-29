<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    // Menampilkan semua data income dan mengembalikannya ke tampilan (view)
    public function index()
    {
        // Mengambil semua data income beserta data bank terkait
        $incomes = Income::with('bankAccount')->get();
        
        // Mengembalikan tampilan 'income.index' dengan data income
        return view('income.index', compact('incomes'));
    }

    // Menampilkan data income berdasarkan ID
    public function show($id)
    {
        $income = Income::with('bankAccount')->find($id);

        if (!$income) {
            return redirect()->route('income.index')->with('error', 'Income not found');
        }

        return view('income.show', compact('income'));
    }

    // Menampilkan form untuk menambahkan income baru
    public function create()
    {
        $banks = BankAccount::with('bank')->get(); // Ambil semua bank untuk dropdown
        dd($banks);
        return view('income.create', compact('banks'));
    }

    // Menyimpan data income baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'income_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'bank_id' => 'nullable|exists:banks,id',
        ]);

        Income::create($validated);

        return redirect()->route('income.index')->with('success', 'Income created successfully');
    }

    // Menampilkan form untuk mengedit data income berdasarkan ID
    public function edit($id)
    {
        $income = Income::find($id);
        $banks = BankAccount::all(); // Ambil semua bank untuk dropdown

        if (!$income) {
            return redirect()->route('income.index')->with('error', 'Income not found');
        }

        return view('income.edit', compact('income', 'banks'));
    }

    // Mengupdate data income berdasarkan ID
    public function update(Request $request, $id)
    {
        $income = Income::find($id);

        if (!$income) {
            return redirect()->route('income.index')->with('error', 'Income not found');
        }

        $validated = $request->validate([
            'income_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $income->update($validated);

        return redirect()->route('income.index')->with('success', 'Income updated successfully');
    }

    // Menghapus data income berdasarkan ID
    public function destroy($id)
    {
        $income = Income::find($id);

        if (!$income) {
            return redirect()->route('income.index')->with('error', 'Income not found');
        }

        $income->delete();

        return redirect()->route('income.index')->with('success', 'Income deleted successfully');
    }
}
