@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Menu')
@section('css')
<link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">Daftar Menu</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('programs.create') }}" class="btn btn-info">Create Menu</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Parent Name</th>
                            <th>Name</th>
                            <th>Route</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                        <tr>
                            <td>{{ $program->parent_name }}</td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->route }}</td>
                            <td>{{ $program->description }}</td>
                            <td class="text-capitalize">{{ $program->status }}</td>
                            <td class="text-capitalize">{{ $program->type }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('programs.edit', $program->id) }}">Edit</a>
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="/assets/static/js/pages/datatables.js"></script>

@endsection