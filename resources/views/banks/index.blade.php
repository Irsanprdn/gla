@extends('template') 

@section('title', 'Bank Account')
@section('css')
<link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <h5 class="card-title">List Bank</h5>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('banks.create') }}" class="btn btn-info">Create Bank</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Bank Code</th>                        
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks as $bank)
                        <tr>
                            <td>{{ $bank->nama_bank }}</td>
                            <td>{{ $bank->kode_bank }}</td>                            
                            <td>
                                <a class="btn btn-warning" href="{{ route('banks.edit', $bank->id_bank) }}">Edit</a>
                                <form action="{{ route('banks.destroy', $bank->id_bank) }}" method="POST" style="display:inline;">
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