@extends('layouts.app')

@section('title')
    Update product
@endsection

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endpush

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }} Info</h5>
                <div class="p-4 rounded">
                    <div class="container mt-4">

                        <form method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $product->name }}" type="text" class="form-control" name="name"
                                       placeholder="Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <img class="mb-3" src="{{ asset($product->image) }}"
                                     style="width: 210px;height: 180px;">
                                <input value="" type="file" class="form-control" name="image">
                            </div>
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                                @foreach($categories as $category)
                                    @if($product->category_id == $category->id)
                                        <option value="{{$category->id}}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input value="{{ $product->price }}" type="text" class="form-control" name="price"
                                       placeholder="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description"
                                          placeholder="Description" required>{{ $product->description }}</textarea>
                            </div>
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select mb-3" name="status" aria-label="Default select example">
                                <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                <option value="0" @if($product->status == 0) selected @endif>Inactive</option>
                            </select>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('product.index') }}" class="btn btn-success text-light">Back</a>
                                <button type="submit" class="btn btn-primary">Save user</button>
                            </div>
                            <input type="hidden" value="{{ $product->id }}" name="id">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endsection
