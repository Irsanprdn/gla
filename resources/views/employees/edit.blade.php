@extends('template') <!-- Menggunakan layout template -->

@section('title', 'Edit Employee')

@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Edit Employee</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submit">Save</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Employee Name</label>
                    <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $employee->email }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" value="{{ $employee->position }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control">{{ $employee->address }}</textarea>
                </div>                
            </div>
        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script>
     $(document).ready(function() {
        // Panggil typeRules di awal untuk menyesuaikan UI berdasarkan tipe yang dipilih
        formatAmount()
    });
    function formatAmount() {
        var amount = document.getElementById("amount").value;
        var parsedAmount = parseFloat(amount);

        // Jika jumlah adalah bilangan bulat, gunakan format tanpa desimal
        var formattedAmount = Number.isInteger(parsedAmount) ?
            parsedAmount.toLocaleString('id-ID') :
            parsedAmount.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        document.getElementById("formattedAmount").innerText = "Jumlah Terformat: " + formattedAmount;
    }
</script>
@endsection