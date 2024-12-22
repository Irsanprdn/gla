@extends('template') 

@section('title', 'Investor')
@section('css')
<link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">Daftar Investor</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('investors.create') }}" class="btn btn-info">Create Investor</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investors as $investor)
                        <tr>
                            <td>{{ $investor->name }}</td>
                            <td>{{ $investor->email }}</td>
                            <td>{{ $investor->phone }}</td>
                            <td>{{ $investor->address }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('investors.edit', $investor->id) }}">Edit</a>
                                <form action="{{ route('investors.destroy', $investor->id) }}" method="POST" style="display:inline;">
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