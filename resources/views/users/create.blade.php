@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Create User')
@section('css')

@endsection

@section('content')
<section class="section">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <h5 class="card-title">Create User</h5>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-success" type="submmit">Save</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <select class="form-control" name="name" id="name" onchange="getEmail(this)">
                        <option value="">None</option>
                        @foreach(\App\Models\Employee::all() as $employee)
                        <option value="{{ $employee->name }}" data-email="{{ $employee->email }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" required oninput="checkPasswordMatch()">
                    <small id="passwordMatchMessage" style="color: red;"></small>
                </div>
            </div>

        </div>
    </form>
</section>
@endsection

@section('js')
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script>
    function getEmail(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var email = selectedOption.getAttribute('data-email');

        $('#email').val(email)
    }

    function checkPasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('cpassword').value;
        var message = document.getElementById('passwordMatchMessage');

        if (confirmPassword === '') {
            message.innerText = '';
            return;
        }

        if (password === confirmPassword) {
            message.style.color = 'green';
            message.innerText = 'Password matches!';
        } else {
            message.style.color = 'red';
            message.innerText = 'Passwords do not match!';
        }
    }
</script>
@endsection