@extends('layouts.app')

@section('title')
    Product list
@endsection

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <h6 class="card-subtitle mb-2 text-muted"> Manage your products here.</h6>
                <form action="{{ route('product.index') }}" id="searchForm" method="GET" class="d-flex align-items-center">
                    <div class="col-auto me-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Search by product name"
                               value="{{ $name }}">
                    </div>
                    <div class="col-auto me-2">
                        <label>Category</label>
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option value="" selected>Filter category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @if($category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto me-2">
                        <label>Price</label>
                        <select class="form-select" name="price" aria-label="Default select example">
                            <option value="" @if($price == null) selected @endif>Filter price</option>
                            <option value="DESC" @if($price == 'DESC') selected @endif>Desc</option>
                            <option value="ASC" @if($price == 'ASC') selected @endif>Asc</option>
                        </select>
                    </div>
                    <div class="col-auto me-2">
                        <label>Sold</label>
                        <select class="form-select" name="sold" aria-label="Default select example">
                            <option value="" @if($sold == null) selected @endif>Filter sold</option>
                            <option value="DESC" @if($sold == 'DESC') selected @endif>Desc</option>
                            <option value="ASC" @if($sold == 'ASC') selected @endif>Asc</option>
                        </select>
                    </div>
                    <div class="col-auto mt-4">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                    <div class="col-auto mt-4 mx-2">
                        <button type="button" id="resetBtn" class="btn btn-outline-danger">Reset</button>
                    </div>
                </form>
                <div class="mt-2">
                    @include('layouts.includes.messages')
                </div>

                <div class="mb-2 text-end">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm float-right">Add product</a>
                </div>

                <table class="table table-striped">
                    <tr>
                        <th width="1%">No</th>
                        <th>Product image</th>
                        <th>Product name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Sold</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th width="3%" colspan="3">Action</th>
                    </tr>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $loop->iteration + $products->perPage() * ($products->currentPage() - 1) }}</td>
                            <td><img src="{{ asset($product->image) }}" style="width: 100px;height: 100px;"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->sold }}</td>
                            <td>
                                <span class="badge bg-{{$product->status == 1 ? 'success' : 'secondary'}}">
                                    {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('Y/m/d H:i') }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('product.show',$product->id) }}">
                                    <i class="fas fa-eye" style="color: #fff;"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('product.edit',$product->id) }}">
                                    <i class="fas fa-pencil-alt" style="color: #fff;"></i>
                                </a>
                            </td>
                            <td>
                                <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                                            class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt" style="color: #fff;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

                <div class="d-flex">
                    {!! $products->links() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
@push('before-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script>
        function confirmDelete(productID,productName) {
            Swal.fire({
                title: 'Are you sure to delete product "' + productName + '"?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + productID).submit();
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
