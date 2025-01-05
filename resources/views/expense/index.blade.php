@extends('template')

@section('title', 'Expense')
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
                    <h5 class="card-title">List Expense</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('expense.create') }}" class="btn btn-info">Create Expense</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Expense</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->expense_name }}</td>
                            <td>{{ date('Y-m-d', strtotime($expense->date)) }}</td>
                            <td>Rp. {{ number_format($expense->amount) }}</td>
                            <td>{{ $expense->account_name }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('expense.edit', $expense->id) }}">Edit</a>
                                <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" style="display:inline;">
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