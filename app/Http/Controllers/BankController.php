<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    // Menampilkan semua data bank
    public function index()
    {
        $banks = Bank::all(); // Ambil semua data bank
        return view('banks.index', compact('banks'));
    }

    // Menampilkan form untuk menambahkan data bank
    public function create()
    {
        return view('banks.create');
    }

    // Menyimpan data bank ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'kode_bank' => 'required|string|max:10',
        ]);

        Bank::create($request->all());

        return redirect()->route('banks.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    // Menampilkan detail bank
    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return view('banks.show', compact('bank'));
    }

    // Menampilkan form untuk mengedit data bank
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('banks.edit', compact('bank'));
    }

    // Memperbarui data bank
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'kode_bank' => 'required|string|max:10',
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->all());

        return redirect()->route('banks.index')->with('success', 'Bank berhasil diperbarui.');
    }

    // Menghapus data bank
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Bank berhasil dihapus.');
    }
}
