@extends('layouts.app')

@section('title')
Product list
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Products</h5>
            <h6 class="card-subtitle mb-2 text-muted"> Manage your products here.</h6>

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
                    <th>Updated_at</th>
                    <th width="3%" colspan="3">Action</th>
                </tr>
                @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ $product->image }}" style="width: 100px;height: 100px;"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->sold }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('Y/m/d H:i') }}</td>
{{--                    <td>--}}
{{--                        <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',--}}
{{--                        $role->id],'style'=>'display:inline']) !!}--}}
{{--                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}--}}
{{--                        {!! Form::close() !!}--}}
{{--                    </td>--}}
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
