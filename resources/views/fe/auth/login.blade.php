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
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>
                    <div class="alert alert-danger" id="login-error" style="display: none;"></div>
                    <button type="submit" class="btn common-btn">
                        Login
                        <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                        <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
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
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#login-form');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const loginError = document.getElementById('login-error');

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Ngăn form submit mặc định

                const email = form.querySelector('input[name="email"]').value.trim();
                const password = form.querySelector('input[name="password"]').value.trim();

                // Reset lỗi
                emailError.textContent = '';
                passwordError.textContent = '';
                loginError.style.display = 'none';
                loginError.textContent = '';

                let hasError = false;

                // Kiểm tra email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    emailError.textContent = 'Email không được để trống.';
                    emailError.style.display = 'block';
                    hasError = true;
                } else if (!emailRegex.test(email)) {
                    emailError.textContent = 'Email không đúng định dạng.';
                    emailError.style.display = 'block';
                    hasError = true;
                } else {
                    emailError.style.display = 'none';
                }

                // Kiểm tra password
                if (!password) {
                    passwordError.textContent = 'Mật khẩu không được để trống.';
                    passwordError.style.display = 'block';
                    hasError = true;
                } else {
                    passwordError.style.display = 'none';
                }

                if (hasError) {
                    return;
                }

                fetch('http://traininglaravel.test/api/login', {
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
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "Success") {
                            localStorage.setItem('token', data.data.authorization.token);
                            localStorage.setItem('user', JSON.stringify(data.data.user));
                            window.location.href = '/';
                        } else {
                            loginError.textContent = 'Tài khoản hoặc mật khẩu không chính xác.';
                            loginError.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        loginError.textContent = 'Có lỗi xảy ra. Vui lòng thử lại.';
                        loginError.style.display = 'block';
                    });
            });
        });
    </script>
@endsection
