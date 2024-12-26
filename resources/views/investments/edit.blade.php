@extends('template') <!-- Menggunakan layout template -->

@section('title', 'Edit Menu')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('investments.update', $investment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Edit Menu</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('investments.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $investment->name) }}" required autocomplete="off">
                </div><br>
                <!-- <div>
                    <label for="investor_id">Investor:</label>
                    <select class="form-control" name="investor_id">
                        <option value="{{ old('name', $investment->investor_id) }}">Choose Investor</option>
                        @foreach($investors as $investor)
                            <option value="{{ $investor->id }}">
                                {{ $investor->name_investor }}
                            </option>
                        @endforeach
                    </select>
                </div><br> -->
                <div>
                    <label for="investor_id">Investor:</label>
                    <select class="form-control" name="investor_id" required>
                        <option value="">Choose Investor</option>
                        @foreach($investors as $investor)
                            <option value="{{ $investor->id }}" 
                                {{ old('investor_id', $investment->investor_id) == $investor->id ? 'selected' : '' }}>
                                {{ $investor->name_investor }}
                            </option>
                        @endforeach
                    </select>
                </div><br>
                <div>
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control" value="{{ old('name', $investment->amount) }}" name="amount" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div><br>
                <div>
                    <label for="investment_date">Investment Date:</label>
                    <input type="date" value="{{ old('name', $investment->investment_date) }}" class="form-control" name="investment_date">
                </div><br>
            </div>
        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
@endsection
