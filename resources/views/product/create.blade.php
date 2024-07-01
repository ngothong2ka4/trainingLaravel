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

                        <form method="POST" id="userForm" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                       placeholder="Name" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input value="{{ old('image') }}" type="file" class="form-control" name="image">
                            </div>
                            <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                                <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                                    <option value="0" selected>Open this select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input value="{{ old('price') }}" type="text" class="form-control" name="price"
                                       placeholder="Price" required>

                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description"
                                          placeholder="Description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select mb-3" name="status" aria-label="Default select example">
                                    <option value="" selected>Open this select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('product.index') }}" class="btn btn-success text-light">Back</a>
                                <button type="submit" class="btn btn-primary">Save product</button>
                            </div>
                            <input type="hidden" value="" name="id">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        @endsection

        @push('after-scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
            <script type="text/javascript">
                $('#userForm').validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        category_id: {
                            required: true,
                        },
                        price: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: "Please enter your name.",
                            minlength: "Your name must be at least 3 characters long"
                        },
                        category_id: {
                            required: "Please enter select an category.",
                        },
                        price: {
                            required: "Please enter a price.",
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('text-danger');
                        error.insertAfter(element);
                    }
                });
            </script>
    @endpush
