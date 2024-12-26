@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Add Asset')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('asset.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Asset</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('asset.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <div>
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required autocomplete="off">
            </div><br>
            <div>
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" required autocomplete="off">
            </div><br>
            <div>
                <label for="serial_number">Serial Number:</label>
                <input type="text" class="form-control" name="serial_number" required autocomplete="off">
            </div><br>
            <div>
                <label for="value">Value:</label>
                <input type="text" class="form-control" name="value" required autocomplete="off">
            </div><br>
        </div>

        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/asset/extensions/jquery/jquery.min.js"></script>
@endsection