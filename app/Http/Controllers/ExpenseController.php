<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // Menampilkan semua data expense dan mengembalikannya ke tampilan (view)
    public function index()
    {
        // Mengambil semua data expense beserta data bank terkait
        $expenses = Expense::leftJoin('bank_accounts', function ($join) {
            $join->on('expenses.bank_account_id', '=', 'bank_accounts.id');
        })->get(); 
        
        // Mengembalikan tampilan 'expense.index' dengan data expense
        return view('expense.index', compact('expenses'));
    }

    // Menampilkan data expense berdasarkan ID
    public function show($id)
    {
        $expense = Expense::with('bankAccount')->find($id);

        if (!$expense) {
            return redirect()->route('expense.index')->with('error', 'Expense not found');
        }

        return view('expense.show', compact('expense'));
    }

    // Menampilkan form untuk menambahkan expense baru
    public function create()
    {
        $banks = BankAccount::leftJoin('bank', function ($join) {
            $join->on('bank.id_bank', '=', 'bank_accounts.bank_id');
        })->get();
        
        return view('expense.create', compact('banks'));
    }

    // Menyimpan data expense baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'bank_account_id' => 'nullable|numeric',
        ]);

        Expense::create($validated);

        return redirect()->route('expense.index')->with('success', 'Expense created successfully');
    }

    // Menampilkan form untuk mengedit data expense berdasarkan ID
    public function edit($id)
    {
        $expense = Expense::find($id);
        $banks = BankAccount::leftJoin('bank', function ($join) {
            $join->on('bank.id_bank', '=', 'bank_accounts.bank_id');
        })->get();

        if (!$expense) {
            return redirect()->route('expense.index')->with('error', 'Expense not found');
        }

        return view('expense.edit', compact('expense', 'banks'));
    }

    // Mengupdate data expense berdasarkan ID
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return redirect()->route('expense.index')->with('error', 'Expense not found');
        }

        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'bank_account_id' => 'nullable|numeric',
        ]);

        $expense->update($validated);

        return redirect()->route('expense.index')->with('success', 'Expense updated successfully');
    }

    // Menghapus data expense berdasarkan ID
    public function destroy($id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return redirect()->route('expense.index')->with('error', 'Expense not found');
        }

        $expense->delete();

        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully');
    }
}
