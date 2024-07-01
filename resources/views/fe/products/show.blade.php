@extends('fe.layouts.app')

@section('banner')
    @include('fe.layouts.components.page-title-area')
@endsection
@section('content')
    <div class="product-details-area ptb-100">
        <div class="container">
            <div class="top">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="outer">
                            <div class="row">
                                <div class="col-sm-9 col-lg-9">
                                    <div class="image-slides owl-carousel owl-theme" data-slider-id="1">
                                        <div class="item">
                                            <div class="top-img">
                                                <img src="{{ asset( $product->image ) }}" alt="Product" style="border-radius: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-content">
                            <h2>{{ $product->name }}</h2>
                            <ul class="reviews">
                                <li>
                                    <h3>{{ $product->price }} VNĐ</h3>
                                </li>
                            </ul>
                            <p>{{ $product->description }}</p>
                            <ul class="tag">
                                <li>Category: <span>{{ $product->category?->name }}</span></li>
                                <li>Status: <span>{{ $product->status = 1 ? 'Active' : 'Inactive' }}</span></li>
                            </ul>
                            <ul class="cart">
                                <form id="buy-product-form" class="d-flex">
                                    <li>
                                        <ul class="number">
                                            <li>
                                                <span class="minus">-</span>
                                                <input type="text" name="quantity" id="quantity" value="1" />
                                                <span class="plus">+</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button class="common-btn" href="#">
                                            Buy
                                            <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                                            <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                                        </button>
                                    </li>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="bottom-description">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products-area pb-70 pt-70" style="background-color: #fff">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="row">
                @foreach($related_products as $related_product)
                    <div class="col-sm-6 col-lg-3">
                        <div class="products-item products-related-item">
                            <div class="top">
                                <a class="wishlist" href="#">
                                    <i class="bx bx-heart"></i>
                                </a>
                                <img src="{{ asset( $related_product->image ) }}" alt="Products" style="border-radius: 10px">
                                <div class="inner">
                                    <h3>
                                        <a href="{{route('detail-product',$related_product->id)}}">
                                            {{ $related_product->name }}</a>
                                    </h3>
                                    <span>{{ $related_product->price }}</span>
                                </div>
                            </div>
                            <div class="bottom">
                                <form class="related-product-form d-flex">
                                    <input type="hidden" name="quantity" value="1" />
                                    <input type="hidden" name="product_id" value="{{ $related_product->id }}">
                                    <i class="bx bx-plus quick-buy"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainForm = document.querySelector('#buy-product-form');
            const quickBuyButtons = document.querySelectorAll('.quick-buy');

            function createOrder(event, form) {
                event.preventDefault(); // Ngăn sự kiện mặc định nếu cần

                const token = localStorage.getItem('token');

                if (!token) {
                    Swal.fire({
                        title: 'Not Logged In',
                        text: 'You need to log in to place an order.',
                        icon: 'warning',
                        confirmButtonText: 'Login'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login'; // Đường dẫn tới trang đăng nhập của bạn
                        }
                    });
                    return;
                }

                const product_id = form.querySelector('input[name="product_id"]').value;
                const quantity = form.querySelector('input[name="quantity"]').value;

                const orderData = {
                    items: [
                        {
                            product_id: product_id,
                            quantity: quantity
                        }
                    ]
                };

                fetch('http://traininglaravel.test/api/create-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify(orderData)
                })
                    .then(response => response.json()) // Chuyển phản hồi sang JSON
                    .then(data => {
                        if (data.status === "Success") {
                            Swal.fire({
                                title: 'Success',
                                text: 'Order created successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/';
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Order creation failed: ' + data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Order creation failed: ' + error.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }

            // Thêm sự kiện submit cho form chi tiết sản phẩm
            mainForm.addEventListener('submit', function(event) {
                createOrder(event, mainForm);
            });

            // Thêm sự kiện click cho từng nút quick buy trong sản phẩm liên quan
            quickBuyButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    const form = button.closest('.related-product-form');
                    createOrder(event, form);
                });
            });
        });
    </script>
@endsection
