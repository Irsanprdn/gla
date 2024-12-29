@extends('template')

@section('title', 'Income')
@section('css')
<link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('content')
<section class="section">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">List Income</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('income.create') }}" class="btn btn-info">Create Income</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Income</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incomes as $income)
                        <tr>
                            <td>{{ $income->income_name }}</td>
                            <td>{{ $income->date }}</td>
                            <td>{{ $income->amount }}</td>
                            <td>{{ $income->nama_bank }}</td>
                            <td>{{ $income->description }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('income.edit', $income->id) }}">Edit</a>
                                <form action="{{ route('income.destroy', $income->id) }}" method="POST" style="display:inline;">
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