<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::leftJoin('bank', function ($join) {
            $join->on('bank.id_bank', '=', 'bank_accounts.bank_id');
        })->get();        
        return view('bank_account.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('bank_account.create');
    }

    public function store(Request $request)
    {
        

        BankAccount::create($request->all());

        return redirect()->route('bank_account.index')->with('success', 'Bank account created successfully.');
    }

    public function show(BankAccount $bankAccount)
    {
        return view('bank_account.show', compact('bankAccount'));
    }

    public function edit(BankAccount $bankAccount)
    {
        return view('bank_account.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        

        $bankAccount->update($request->all());

        return redirect()->route('bank_account.index')->with('success', 'Bank account updated successfully.');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();

        return redirect()->route('bank_account.index')->with('success', 'Bank account deleted successfully.');
    }
}
