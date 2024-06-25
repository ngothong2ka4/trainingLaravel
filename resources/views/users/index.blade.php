@extends('layouts.app')

@section('title')
User List
@endsection

@push('before-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Users</h5>
            <h6 class="card-subtitle mb-2 text-muted">Manage User list here.</h6>

            <div class="mt-2">
                @include('layouts.includes.messages')
            </div>

            <form action="" method="get">
                    <div class="row">
                    <div class="mb-3 col-3">
                        <label for="name_email" class="form-label ">Name / Email</label>
                        <input  type="text" class="form-control form-control-sm" name="name_email" placeholder="Search Name Or Email" value="{{ request('name_email') }}">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="name" class="form-label">Type</label>
                        <select name="type" id="" class="form-control form-control-sm">
                            <option value="" disabled selected>Choose type</option>
                            <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="mb-3 col-3 ">
                        <input type="submit" class=" btn btn-primary btn-sm" style="margin-top:30px" value="Search">
                    </div>
                </div>
            </form>
            <div class="mb-2 text-end">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add User</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="1%">NO</th>
                        <th scope="col" width="15%">Name</th>
                        <th scope="col" width="10%">Email</th>
                        {{-- <th scope="col" width="10%">Username</th> --}}
                        <th scope="col" width="5%">Roles</th>
                        <th scope="col" width="1%" colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key=>$user)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->type == 1)
                                {!! '<span class="badge bg-primary">Admin</span>' !!}
                            @elseif ($user->type == 2)
                            {!! '<span class="badge bg-info">User</span>' !!}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}">
                                <i class="fas fa-eye" style="color: #000000;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fas fa-pencil-alt" style="color: #000000;"></i>
                            </a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this user??");']) !!}
                                <button type="submit" style="background: none; border: none; padding: 0; margin: 0; color: #000000;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $users->links() !!}
            </div>

        </div>
    </div>
</div>
@endsection

