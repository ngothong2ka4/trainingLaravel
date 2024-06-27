@extends('layouts.app')

@section('title', 'Orders List')

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <h6 class="card-subtitle mb-2 text-muted">Manage your orders here.</h6>
                <div class="text-end mb-3">
                    <form id="searchForm" action="{{ route('order.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="col-auto me-2">
                            <input type="text" name="product_name" class="form-control" placeholder="Search by product name" value="{{ request()->get('product_name') }}">
                        </div>
                        <div class="col-auto me-2">
                            <select name="status" class="form-control">
                                <option value="">Select status</option>
                                <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>New</option>
                                <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>Done</option>
                                <option value="3" {{ request()->get('status') == '3' ? 'selected' : '' }}>Buyer Cancel</option>
                                <option value="4" {{ request()->get('status') == '4' ? 'selected' : '' }}>Admin Cancel</option>
                            </select>
                        </div>
                        <div class="col-auto me-2">
                            <input type="text" name="from_date" id="from_date" class="form-control" value="{{ request()->get('from_date') }}" placeholder="Từ ngày: ">
                        </div>
                        <div class="col-auto me-2">
                            <input type="text" name="to_date" id="to_date" class="form-control" value="{{ request()->get('to_date') }}" placeholder="Đến ngày: ">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>
    {{--                        <div class="col-auto">--}}
    {{--                            <button type="button" id="resetButton" class="btn btn-outline-primary">Reset</button>--}}
    {{--                        </div>--}}
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="60px">No</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Buyer</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Buy At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $key => $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($order->image) }}" alt="" style="max-width: 100px;"></td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->quatity }}</td>
                            <td>
                                @if($order->status_id == 1)
                                    <span class="badge bg-warning">{{$order->status_name}}</span>
                                @elseif($order->status_id == 2)
                                    <span class="badge bg-success">{{$order->status_name}}</span>
                                @elseif($order->status_id == 3)
                                    <span class="badge bg-danger">{{$order->status_name}}</span>
                                @elseif($order->status_id == 4)
                                    <span class="badge bg-dark">{{$order->status_name}}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                            <td>{{ $order->updated_at->format('Y/m/d H:i') }}</td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ route('order.show', $order->id) }}">
                                    <i class="fas fa-eye" style="color: #fff;"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#from_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#to_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
@endpush
