@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Menu')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('programs.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create Menu</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="type">Type:</label>
                    <select class="form-control" name="type" onchange="typeRules(this)">
                        <option value="">Choose Type</option>
                        <option value="parent">Parent</option>
                        <option value="child">Child</option>
                    </select>
                </div><br>
                <div>
                    <label for="parent_id">Parent Program:</label>
                    <select class="form-control" name="parent_id">
                        <option value="">None</option>
                        @foreach(\App\Models\Program::whereNull('parent_id')->get() as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div><br>
                <div>
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div><br>
                <div>
                    <label for="name">Route:</label>
                    <input type="text" class="form-control" name="route">
                </div><br>
                <div>
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description"></textarea>
                </div><br>
                <div>
                    <label for="status">Status:</label>
                    <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
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
    function typeRules(e) {
        var type = $(e).val()
        if (type === 'parent') {
            // Sembunyikan Parent Program dan Route
            $('select[name="parent_id"]').closest('div').hide();
            $('input[name="route"]').closest('div').hide();
        } else if (type === 'child') {
            // Tampilkan Parent Program dan Route
            $('select[name="parent_id"]').closest('div').show();
            $('input[name="route"]').closest('div').show();
        }
    }
</script>
@endsection