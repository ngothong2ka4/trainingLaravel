@extends('layouts.app')

@section('title', 'Categories List')
@push('before-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
@endpush
@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <h6 class="card-subtitle mb-2 text-muted">Manage your categories here.</h6>
                <div class="text-end mb-3">
                    <form action="{{ route('categories.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="col-auto me-2">
                            <input type="text" name="search" class="form-control" placeholder="Search by category name" value="{{ request()->get('search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>
                    </form>
                </div>
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
                            <td style="display: flex; gap: 10px;">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id], 'style' => 'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
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
