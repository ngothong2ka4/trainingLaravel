@extends('layouts.app')

@section('title')
    Show product
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show product {{ $product->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted"> Detail product {{ $product->name }}.</h6>
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded-start" alt="...">

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Price: {{ $product->price }} $</p>
                            <p class="card-text">Category: {{ $product->category->name }}</p>
                            <p class="card-text">Status: {{ $product->status == 1 ? 'Active' : 'Inactive' }}</p>
                            <p class="card-text">Sold: {{ $product->sold }}</p>
                            <p class="card-text">Description:{{ $product->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated {{ $product->updated_at }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-between my-3 mx-3">
            <a href="{{ route('product.index') }}" class="btn btn-success">Back</a>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script type="text/javascript">

    </script>
@endpush
