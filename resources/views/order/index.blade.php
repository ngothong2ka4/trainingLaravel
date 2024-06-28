@extends('layouts.app')

@section('title', 'Orders List')

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <h6 class="card-subtitle mb-2 text-muted">Manage your orders here.</h6>
                <form id="searchForm" action="{{ route('order.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="col-auto me-2">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Search by product name" value="{{ request()->get('product_name') }}">
                        </div>
                        <div class="col-auto me-2">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">Select status</option>
                                <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>New</option>
                                <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>Done</option>
                                <option value="3" {{ request()->get('status') == '3' ? 'selected' : '' }}>Buyer Cancel</option>
                                <option value="4" {{ request()->get('status') == '4' ? 'selected' : '' }}>Admin Cancel</option>
                            </select>
                        </div>
                        <div class="col-auto me-2">
                            <label>Start date</label>
                            <input type="text" name="from_date" id="from_date" class="form-control" value="{{ request()->get('from_date') }}" placeholder="Search start date">
                        </div>
                        <div class="col-auto me-2">
                            <label>End date</label>
                            <input type="text" name="to_date" id="to_date" class="form-control" value="{{ request()->get('to_date') }}" placeholder="Search for end date">
                        </div>
                        <div class="col-auto mt-4 me-2">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>
                        <div class="col-auto mt-4 me-2">
                            <button type="button" id="resetBtn" class="btn btn-outline-danger">Reset</button>
                        </div>
                    </form>
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
                            <td>{{ $loop->iteration + $orderDetails->perPage() * ($orderDetails->currentPage() - 1) }}</td>
                            <td><img src="{{ asset($order->image) }}" alt="" style="max-width: 100px;"></td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->quantity }}</td>
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

                <div class="d-flex">
                    {!! $orderDetails->links() !!}
                </div>

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
