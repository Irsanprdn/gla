@extends('template') <!-- Menggunakan layout template -->

@section('title', 'Edit Asset')

@section('css')
 
@endsection

@section('content')
<section class="section">
    <form action="{{ route('asset.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Edit Asset</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('asset.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $asset->name) }}" required autocomplete="off">
                </div><br>
                <div>
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description', $asset->description) }}" required autocomplete="off">
                </div><br>
                <div>
                    <label for="serial_number">Serial Number:</label>
                    <input type="text" class="form-control" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" required autocomplete="off">
                </div><br>
                <div>
                    <label for="value">Value:</label>
                    <input type="text" class="form-control" name="value" value="{{ old('value', $asset->value) }}" required autocomplete="off">
                </div><br>
            </div>
        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script>
    // Script tambahan jika dibutuhkan
</script>
@endsection
