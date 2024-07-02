@extends('fe.layouts.app')
<<<<<<< Updated upstream

{{--@section('banner')--}}
{{--    @include('fe.layouts.components.page-title-area')--}}
{{--@endsection--}}

=======
>>>>>>> Stashed changes
@section('content')
    <div class="product-details-area ptb-100">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="order-history-body">
                <!-- Data will be appended here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://traininglaravel.test/api/transaction-history', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Đảm bảo token được lưu trong localStorage
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        const orders = data.data;
                        const tbody = document.getElementById('order-history-body');
                        let index = 1; // Biến đếm bắt đầu từ 1
                        orders.forEach(order => {
                            order.order_item.forEach(item => {
                                const createdAt = new Date(order.created_at).toLocaleString('en-CA', {
                                    timeZone: 'UTC',
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: false
                                });
                                const updatedAt = new Date(order.updated_at).toLocaleString('en-CA', {
                                    timeZone: 'UTC',
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: false
                                });
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
<<<<<<< Updated upstream
                                <th scope="row">${index++}</th> <!-- Sử dụng biến đếm -->
                                <td>${item.api_product.name}</td>
                                <td><img src="${item.api_product.image}" alt="" width="50"></td>
                                <td>${order.status.name}</td>
                                <td>${item.quantity}</td>
                                <td>${order.price}</td>
                                <td>${createdAt}</td> <!-- Định dạng ngày tạo -->
                                <td>${updatedAt}</td> <!-- Định dạng ngày cập nhật -->
                                <td>
                                    ${order.status.name === 'New' ? `<input type="button" value="Cancel Order" onclick="cancelOrder(${order.id})">` : 'N/A'}
                                </td>
                            `;
=======
<th scope="row">${index++}</th> <!-- Sử dụng biến đếm -->
<td>${item.api_product.name}</td>
<td><img src="${item.api_product.image}" alt="" width="50"></td>
<td>${order.status.name}</td>
<td>${item.quantity}</td>
<td>${order.price}</td>
<td>${createdAt}</td> <!-- Định dạng ngày tạo -->
<td>${updatedAt}</td> <!-- Định dạng ngày cập nhật -->
<td>
${order.status.name === 'New' ? `<input type="button" value="Cancel Order" onclick="confirmCancelOrder(${item.id})">` : 'N/A'}
</td>
`;
>>>>>>> Stashed changes
                                tbody.appendChild(tr);
                            });
                        });
                    }
                })
                .catch(error => console.error('Error fetching transaction history:', error));
        });
<<<<<<< Updated upstream

        function cancelOrder(orderId) {
            fetch(`http://traininglaravel.test/api/cancel-order/${orderId}`, {
=======
        function confirmCancelOrder(orderItemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelOrder(orderItemId);
                }
            })
        }
        function cancelOrder(orderItemId) {
            fetch(`http://traininglaravel.test/api/cancel-order/${orderItemId}`, {
>>>>>>> Stashed changes
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        Swal.fire(
                            'Deleted!',
                            'Your order has been cancelled.',
                            'success'
                        );
                        location.reload(); // Reload the page to reflect the changes
                    } else {
<<<<<<< Updated upstream
                        alert('Failed to cancel the order. Please try again.');
                    }
                })
                .catch(error => console.error('Error cancelling order:', error));
=======
                        Swal.fire(
                            'Failed!',
                            'Failed to cancel the order. Please try again.',
                            'error'
                        );
                        console.error('Failed to cancel the order:', data.message);
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        'Error cancelling order. Please try again.',
                        'error'
                    );
                    console.error('Error cancelling order:', error);
                });
>>>>>>> Stashed changes
        }
    </script>
@endsection
