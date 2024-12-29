@extends('template') <!-- Menggunakan layout template -->

@section('title', 'Edit Bank')

@section('css')
 
@endsection

@section('content')
<section class="section">
    <form action="{{ route('banks.update', $bank->id_bank) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Edit Bank Account</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('banks.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <label for="nama_bank">Bank Name:</label>
                    <input type="text" class="form-control" name="nama_bank" value="{{ old('nama_bank', $bank->nama_bank) }}" required autocomplete="off">
                </div><br>
                <div>
                    <label for="kode_bank">Bank Code:</label>
                    <input type="text"  oninput="this.value = this.value.replace(/\D/g, '')"  class="form-control" name="kode_bank" value="{{ old('kode_bank', $bank->kode_bank) }}" required autocomplete="off">
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
