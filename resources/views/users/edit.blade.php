@extends('layouts.app')

@section('title')
Edit User
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update user</h5>

            <div class="container mt-4">
                <form method="post" action="{{ route('users.update', $user->id) }}" id="userForm">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Name"
                            required>

                        @error('name')
                            span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="{{ $user->email }}" type="email" class="form-control" name="email"
                            placeholder="Email address" required>
                        
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                            @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" required>
                            <option value="1" {{ $user->type ==1
                                    ? 'selected'
                                    : '' }}>Admin</option>
                            <option value="2" {{ $user->type ==2
                                    ? 'selected'
                                    : '' }}>User</option>
                        </select>
                        @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update user</button>
                    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
                </form>
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
            $('#userForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
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