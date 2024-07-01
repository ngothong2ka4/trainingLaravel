@extends('layouts.app')

@section('title')
User List
@endsection

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <input  type="text" class="form-control" name="name_email" placeholder="Search Name Or Email" value="{{ request('name_email') }}">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="name" class="form-label">Type</label>
                        <select name="type" id="" class="form-control">
                            <option value="" disabled selected>Choose type</option>
                            <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="mb-3 col-3 ">
                        <input type="submit" class=" btn btn-outline-primary " style="margin-top:30px" value="Search">
                        <input type="button" id="resetBtn" class="btn btn-outline-danger" style="margin-top:30px" value="Reset">
                    </div>
                </div>
            </form>
            <div class="mb-2 text-end">
                <a href="{{ route('users.create') }}" class="btn btn-primary float-right">Add User</a>
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
                        <th scope="row">{{ $loop->iteration + $users->perPage() * ($users->currentPage() - 1) }}</th>
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
                            <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
                                <i class="fas fa-eye" style="color: #fff;"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                                <i class="fas fa-pencil-alt" style="color: #fff;"></i>
                            </a>
                        </td>
                        <td>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt" style="color: #fff;"></i>
                                </button>
                            </form>
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

@push('before-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script>
        
        function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        })
        }

        @if(session('msg'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('msg') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush
@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#resetBtn').click(function(event) {
                event.preventDefault()
                // Clear all input and select fields
                $('#searchForm').find('input[type="text"], select').val('');
                window.location.replace(location.origin + location.pathname)
            });
        });
    </script>
@endpush