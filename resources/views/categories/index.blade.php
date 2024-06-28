@extends('layouts.app')

@section('title', 'Categories List')

@push('before-styles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@push('before-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
@endpush

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <h6 class="card-subtitle mb-2 text-muted">Manage your categories here.</h6>
                    <form action="{{ route('categories.index') }}" method="GET" id="searchForm" class="d-flex align-items-center">
                        <div class="col-auto me-2">
                            <label>Category</label>
                            <input type="text" name="search" class="form-control" placeholder="Search by category name" value="{{ request()->get('search') }}">
                        </div>
                        <div class="col-auto mt-4">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>
                        <div class="col-auto mt-4 mx-2">
                            <button type="button" id="resetBtn" class="btn btn-outline-danger">Reset</button>
                        </div>
                    </form>
                <div class="text-end">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">Add categories</a>
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="60px">No</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Created by</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col" colspan="3" width="1%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $loop->iteration + $categories->perPage() * ($categories->currentPage() - 1) }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_by }}</td>
                            <td>{{ $category->created_at->format('Y/m/d H:i') }}</td>
                            <td>{{ $category->updated_at->format('Y/m/d H:i') }}</td>

                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('categories.show', $category->id) }}">
                                    <i class="fas fa-eye" style="color: #fff;"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('categories.edit', $category->id) }}">
                                    <i class="fas fa-pencil-alt" style="color: #fff;"></i>
                                </a>
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'style' => 'display:inline', 'id' => 'delete-form-' . $category->id]) !!}
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">
                                    <i class="fas fa-trash-alt" style="color: #fff;"></i>
                                </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('before-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(categoryId) {
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
                    document.getElementById('delete-form-' + categoryId).submit();
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
        @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK
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
