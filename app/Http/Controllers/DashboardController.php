<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data for total pemasukan, pengeluaran, modal awal, and saldo tersisa
        $totalPemasukan = 5000000; // Example value for total income
        $totalPengeluaran = 2000000; // Example value for total expenses
        $modalAwal = 10000000; // Example value for initial capital
        $saldoTersisa = $modalAwal + $totalPemasukan - $totalPengeluaran; // Calculating remaining balance

        // Dummy data for transaksiTerbaru (transactions)
        $transaksiTerbaru = [
            (object)[
                'tanggal' => Carbon::now()->subDays(1), 
                'jenis' => 'Pemasukan', 
                'nominal' => 1000000, 
                'deskripsi' => 'Pemasukan dari penjualan produk'
            ],
            (object)[
                'tanggal' => Carbon::now()->subDays(2),
                'jenis' => 'Pengeluaran',
                'nominal' => 500000,
                'deskripsi' => 'Pembayaran tagihan listrik'
            ],
            (object)[
                'tanggal' => Carbon::now()->subDays(3),
                'jenis' => 'Pemasukan',
                'nominal' => 1500000,
                'deskripsi' => 'Pemasukan dari jasa konsultasi'
            ],
            (object)[
                'tanggal' => Carbon::now()->subDays(4),
                'jenis' => 'Pengeluaran',
                'nominal' => 300000,
                'deskripsi' => 'Pembelian perlengkapan kantor'
            ],
            (object)[
                'tanggal' => Carbon::now()->subDays(5),
                'jenis' => 'Pemasukan',
                'nominal' => 2000000,
                'deskripsi' => 'Pemasukan dari kerjasama proyek'
            ]
        ];

        // Passing the data to the view
        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'modalAwal', 'saldoTersisa', 'transaksiTerbaru'));
    }
}
