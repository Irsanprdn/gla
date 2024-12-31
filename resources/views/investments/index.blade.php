@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Investment')
@section('css')
<link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">Daftar Investment</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('investments.create') }}" class="btn btn-info">Create Investment</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Investor</th>
                            <th>Investment Date</th>
                            <!-- <th>Duration Months</th>
                            <th>Rate of Return</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investments as $investment)
                        <tr>
                            <td>{{ $investment->name }}</td>
                            <td>{{ $investment->amount }}</td>
                            <td>{{ $investment->investor_name }}</td>
                            <td>{{ $investment->investment_date}}</td>
                            <!-- <td>{{ $investment->duration_months }}</td>
                            <td>{{ $investment->rate_of_return }}</td> -->
                            <td>
                                <a class="btn btn-warning" href="{{ route('investments.edit', $investment->id) }}">Edit</a>
                                <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" style="display:inline;">
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