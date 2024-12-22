@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Add Investor')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('investors.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Investor</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('investors.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <div>
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required autocomplete="off">
            </div><br>
            <div>
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required autocomplete="off">
            </div><br>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" required autocomplete="off">
            </div><br>
            <div>
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" required autocomplete="off"></textarea>
            </div><br>
        </div>

        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
@endsection