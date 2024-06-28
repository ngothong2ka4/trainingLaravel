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
                                <li>
                                    <ul class="number">
                                        <li>
                                            <span class="minus">-</span>
                                            <input type="text" value="1" />
                                            <span class="plus">+</span>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="common-btn" href="#">
                                        Add To Cart
                                        <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                                        <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                                    </a>
                                </li>
                            </ul>
                            <a class="wishlist-btn" href="#">
                                <i class="bx bx-heart"></i>
                                Add To Heart
                            </a>
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
                                        <a href="">{{ $related_product->name }}</a>
                                    </h3>
                                    <span>{{ $related_product->price }}</span>
                                </div>
                            </div>
                            <div class="bottom">
                                <a class="cart-text" href="#">Add To Cart</a>
                                <i class="bx bx-plus"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
