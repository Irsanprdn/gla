@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Create Income')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('income.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Income</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('income.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="income_name">Income Name</label>
                    <input type="text" name="income_name" id="income_name" class="form-control" required>
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
        var formattedAmount = parseFloat(amount).toLocaleString('en-US', {
            style: 'decimal',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        document.getElementById("formattedAmount").innerText = "Formatted Amount: " + formattedAmount;
    }
</script>
@endsection