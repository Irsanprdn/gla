@extends('template') <!-- Menggunakan layout template -->

@section('title', 'Edit Income')

@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('income.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Edit Income</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('income.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="income_name">Income Name</label>
                    <input type="text" name="income_name" value="{{ $income->income_name }}" id="income_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" value="{{ $income->amount }}" id="amount" class="form-control" required step="0.01" oninput="formatAmount()">
                    <small id="formattedAmount" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="{{ date('Y-m-d', strtotime($income->date)) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ $income->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="bank_account_id">Bank Account</label>
                    <select name="bank_account_id" id="bank_account_id" class="form-control" required>
                        <option value="">None</option>
                        @foreach($banks as $bank)
                        <option value="{{ $bank->id }}" {{ $income->bank_account_id == $bank->id ? 'selected' : ''}}>{{ $bank->nama_bank }} - {{ $bank->account_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script>
     $(document).ready(function() {
        // Panggil typeRules di awal untuk menyesuaikan UI berdasarkan tipe yang dipilih
        formatAmount()
    });
    function formatAmount() {
        var amount = document.getElementById("amount").value;
        var parsedAmount = parseFloat(amount);

        // Jika jumlah adalah bilangan bulat, gunakan format tanpa desimal
        var formattedAmount = Number.isInteger(parsedAmount) ?
            parsedAmount.toLocaleString('id-ID') :
            parsedAmount.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        document.getElementById("formattedAmount").innerText = "Jumlah Terformat: " + formattedAmount;
    }
</script>
@endsection