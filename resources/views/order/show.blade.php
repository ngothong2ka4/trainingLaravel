@extends('layouts.app')

@section('title', 'Order Details')
@push('before-styles')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Details</h5>
            <div class="card mb-3" style="max-width: 100%;">
                <h2 class="mt-20">Order Information</h2>
                <div class="row g-0">
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div>
                                <p class="card-text">Order ID: {{ $order->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div>
                                @if($order->status_id == 1)
                                    <span class="badge bg-warning">New</span>
                                @elseif($order->status_id == 2)
                                    <span class="badge bg-success">Done</span>
                                @elseif($order->status_id == 3)
                                    <span class="badge bg-danger">Buyer Cannel</span>
                                @elseif($order->status_id == 4)
                                    <span class="badge bg-dark">Admin Cannel</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div>
                                <p class="card-text">Buyer: {{ $order->user_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div>Amount: {{ $order->total_amount }}</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div>
                                <p class="card-text">Buy At: {{ $order->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div>
                                <p class="card-text">Updated At: {{ $order->updated_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 center-divider">
                            <!-- Đường kẻ dưới chỉ nằm ở giữa màn hình -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <h2 class="mb-5">Product Information</h2>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <p class="card-text">Product Name: {{ $order->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="card-text">Unit Price: {{ $order->price }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="card-text">Quantity: {{ $order->quatity }}</p>
                            </div>

                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="card-text"><img src="{{ asset($order->image) }}" alt="" style="width: 100px"></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="card-text">Categories: {{ $order->category_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-between my-3 mx-3">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('order.index') }}" class="btn btn-primary">Back to Orders</a>
                </div>
                @if($order->status_id == 1)
                    <div class="col-md-4 d-flex justify-content-end">
                        <div>
                            <a href="{{ route('order.cancel', ['id' => $order->id]) }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="ml-20">
                            <a href="{{ route('order.done', ['id' => $order->id]) }}" class="btn btn-success">Done</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
