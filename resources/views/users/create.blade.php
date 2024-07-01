@extends('layouts.app')

@section('title')
Create User
@endsection


@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add new product</h5>
            <div class="p-4 rounded">
                <div class="container mt-4">

                    <form method="POST" action="" id="userForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}" 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                placeholder="Name" required>
                    
                            @error('name')
                                span class="text-danger">{{ $message }}</span>
                            @enderror
                    
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input value="{{ old('email') }}"
                                type="email" 
                                class="form-control" 
                                name="email" 
                                placeholder="Email address" required>
                    
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input value="{{ old('password') }}"
                                type="text" 
                                class="form-control" id="password"
                                name="password" 
                                placeholder="password" required>
                    
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="" class="form-select">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="text-danger text-left">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Save user</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                    </form>
                </div>

            </div>
        </div>
    </div>

    </div>
    
@endsection

@push('after-scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('#password').on('input', function() {
            var password = $(this).val();
            var maskedPassword = '';
            for (var i = 0; i < password.length; i++) {
                maskedPassword += '•';
            }
            $(this).val(maskedPassword);
            });

            $('#userForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must be at least 3 characters long"
                    },
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element);
                }
        });
    });
    </script>
@endpush
