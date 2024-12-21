<?php
// app/Http/Controllers/LoanController.php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Asset;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Menampilkan daftar pinjaman
    public function index()
    {
        $loans = Loan::with('asset')->get();
        return view('loans.index', compact('loans'));
    }

    // Menampilkan form untuk menambah pinjaman baru
    public function create()
    {
        $assets = Asset::all(); // Ambil semua aset untuk dipilih
        return view('loans.create', compact('assets'));
    }

    // Menyimpan pinjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset_id' => 'required|exists:assets,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $loan = Loan::create($request->all());

        // Menambahkan loan_id ke asset yang terkait
        $asset = Asset::findOrFail($request->asset_id);
        $asset->loan_id = $loan->id; // Menyimpan loan_id di tabel asset
        $asset->save();
        return redirect()->route('loans.index')->with('success', 'Loan created successfully');
    }

    // Menampilkan form untuk mengedit pinjaman
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $assets = Asset::all(); // Ambil semua aset untuk dipilih
        return view('loans.edit', compact('loan', 'assets'));
    }

    // Memperbarui pinjaman
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset_id' => 'required|exists:assets,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update($request->all());

        // Menambahkan loan_id ke asset yang terkait
        $asset = Asset::findOrFail($request->asset_id);
        $asset->loan_id = $loan->id; // Menyimpan loan_id di tabel asset
        $asset->save();
        
        return redirect()->route('loans.index')->with('success', 'Loan updated successfully');
    }

    // Menghapus pinjaman
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully');
    }

    // Menambahkan aset ke pinjaman
    public function addAsset(Request $request, $loanId)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
        ]);

        $loan = Loan::findOrFail($loanId);
        $loan->asset_id = $request->asset_id;
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Asset added to loan successfully');
    }
}
