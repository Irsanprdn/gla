@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Create Expense')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('expense.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Expense</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('expense.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="expense_name">Expense Name</label>
                    <input type="text" name="expense_name" id="expense_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" required step="0.01" oninput="formatAmount()">
                    <small id="formattedAmount" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="bank_account_id">Bank Account</label>
                    <select name="bank_account_id" id="bank_account_id" class="form-control" required>
                        <option value="">None</option>
                        @foreach($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->nama_bank }} - {{ $bank->account_name }}</option>
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