@extends('fe.layouts.app')

{{--@section('banner')--}}
{{--    @include('fe.layouts.components.page-title-area')--}}
{{--@endsection--}}

@section('content')
    <div class="product-details-area ptb-100">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody id="order-history-body">
                <!-- Data will be appended here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://127.0.0.1:8000/api/transaction-history', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Đảm bảo token được lưu trong localStorage
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        const orders = data.data;
                        const tbody = document.getElementById('order-history-body');
                        orders.forEach(order => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                            <th scope="row">${order.id}</th>
                            <td>${order.user_id}</td>
                            <td>${order.status_id}</td>
                            <td>${order.price}</td>
                            <td>${order.created_at}</td>
                            <td>${order.updated_at}</td>
                        `;
                            tbody.appendChild(tr);
                        });
                    }
                })
                .catch(error => console.error('Error fetching transaction history:', error));
        });
    </script>
@endsection
