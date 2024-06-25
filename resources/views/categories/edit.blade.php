@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Category</h5>

                <div class="container mt-4">
                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $category->name) }}"
                                   placeholder="Enter category name" >
                            <div id="nameError" class="invalid-feedback"></div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                   id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                                   placeholder="Enter category slug" >
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/categories.js') }}"></script>
@endsection
