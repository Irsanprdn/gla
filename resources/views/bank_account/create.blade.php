@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Create Bank Account')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('bank_account.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Bank Account</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('bank_account.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="account_number">Account Number:</label>
                    <input type="text" class="form-control" oninput="this.value = this.value.replace(/\D/g, '')"  name="account_number" required autocomplete="off">
                </div><br>
                <div>
                    <label for="account_name">Account Name:</label>
                    <input type="text" class="form-control" name="account_name" required autocomplete="off">
                </div><br>
                <div>
                    <label for="bank_id">Bank Name:</label>
                    <select class="form-control" name="bank_id">
                        <option value="">None</option>
                        @foreach(\App\Models\Bank::get() as $bank)
                        <option value="{{ $bank->id_bank }}">{{ $bank->nama_bank }}</option>
                        @endforeach
                    </select>
                </div><br>
            </div>

        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
@endsection