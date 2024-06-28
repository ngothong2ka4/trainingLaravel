@extends('fe.layouts.app')

@section('banner')
    @include('fe.layouts.components.page-title-area')
@endsection

@section('content')
    <div class="user-area ptb-100">
        <div class="container">
            <div class="user-item">
                <form id="login-form" method="POST" action="{{ route('login.authenticate') }}">
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
            document.querySelector('form').addEventListener('submit', function (event) {
                event.preventDefault(); // Ngăn form submit mặc định

                const email = document.querySelector('input[name="email"]').value;
                const password = document.querySelector('input[name="password"]').value;

                fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            123213;
                            // throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Chuyển hướng đến trang khác
                        // window.location.href = '/dashboard'; // Thay đổi link đến trang dashboard của bạn
                    })
                    .catch(error => {
                        // Xử lý khi có lỗi
                        // console.error('There was a problem with the fetch operation:', error);
                        // alert('Login failed: ' + error.message);
                    });
            });
        });
    </script>
@endsection
