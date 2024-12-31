@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Add Investment')
@section('css')

@endsection

@section('content')
<style>
    /* Menghilangkan panah atas dan bawah */
    input[type="number"]::-webkit-inner-spin-button, 
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<section class="section">
    <form action="{{ route('investments.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Investment</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('investments.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" required autocomplete="off">
                </div><br>
                <div>
                    <label for="investor_id">Investor:</label>
                    <select class="form-control" name="investor_id">
                        <option value="">Choose Investor</option>
                        @foreach($investors as $investor)
                            <option value="{{ $investor->id }}">
                                {{ $investor->name_investor }}
                            </option>
                        @endforeach
                    </select>
                </div><br>
                <div>
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control" name="amount" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div><br>
                <div>
                    <label for="investment_date">Investment Date:</label>
                    <input type="date" class="form-control" name="investment_date">
                </div><br>
            </div>
        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
@endsection