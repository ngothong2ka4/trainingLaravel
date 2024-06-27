@extends('layouts.app')

@section('title')
    Create Product
@endsection

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add new product</h5>
                <div class="p-4 rounded">
                    <div class="container mt-4">

                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                       placeholder="Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input value="{{ old('image') }}" type="file" class="form-control" name="image">
                            </div>
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                                <option value="0" selected>Open this select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input value="{{ old('price') }}" type="text" class="form-control" name="price"
                                       placeholder="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description"
                                          placeholder="Description" required></textarea>
                            </div>
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select mb-3" name="status" aria-label="Default select example">
                                <option value="" selected>Open this select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('product.index') }}" class="btn btn-success text-light">Back</a>
                                <button type="submit" class="btn btn-primary">Save user</button>
                            </div>
                            <input type="hidden" value="" name="id">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        @endsection

        @push('after-scripts')
            <script type="text/javascript">

            </script>
    @endpush
