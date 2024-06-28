@extends('fe.layouts.app')

@section('banner')
    @include('fe.layouts.components.page-title-area')
@endsection

@section('content')
    <div class="user-area ptb-100">
        <div class="container">
            <div class="user-item">
                <form id="login-form">
                    @csrf
                    <h2>Login</h2>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn common-btn">
                        Login
                        <img src="assets/images/shape1.png" alt="Shape">
                        <img src="assets/images/shape2.png" alt="Shape">
                    </button>
                    <h4>Or</h4>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="bx bxl-facebook"></i>
                                Login With Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bx bxl-google"></i>
                                Login With Google
                            </a>
                        </li>
                    </ul>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#login-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Ngăn form submit mặc định

                const email = form.querySelector('input[name="email"]').value;
                const password = form.querySelector('input[name="password"]').value;

                fetch('http://127.0.0.1:8000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                    .then(response => response.json()) // Chuyển phản hồi sang JSON
                    .then(data => {
                        if (data.status === "Success") {
                            localStorage.setItem('token', data.data.authorization.token);
                            localStorage.setItem('user', JSON.stringify(data.data.user));
                            window.location.href = '/'; // Thay đổi link đến trang dashboard của bạn
                        } else {
                            alert('Login failed: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        alert('Login failed: ' + error.message);
                    });
            });
        });
    </script>
@endsection
