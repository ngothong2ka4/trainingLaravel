@extends('fe.layouts.app')

@section('banner')
    @include('fe.layouts.components.banner-area')
@endsection
@section('content')
    <div class="products-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sorting-menu">
                        <ul class="justify-content-center">
                            <li class="filter active" data-filter="all">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-square"></i>
                                    <span>All</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".armchair">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-armchair"></i>
                                    <span>Armchair</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".sofa">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-sofa"></i>
                                    <span>Sofa</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".computer">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-table"></i>
                                    <span>Computer Desk</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".desk">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-desk-chair"></i>
                                    <span>Desk Chair</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".center">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-table-1"></i>
                                    <span>Center Table</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".book">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-shelf"></i>
                                    <span>Book Shelf</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".cabinet">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-cabinet"></i>
                                    <span>Cabinet</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".bed">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-bed"></i>
                                    <span>Bed</span>
                                </div>
                            </li>
                            <li class="filter" data-filter=".center-table">
                                <div class="products-thumb">
                                    <img src="{{ asset('fe/assets/images/products/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/products/shape2.png') }}" alt="Shape">
                                    <i class="flaticon-dresser"></i>
                                    <span>Dressing Table</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="Container" class="row justify-content-center">
                        <div class="col-sm-6 col-lg-4 mix armchair center-table">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products1.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">White Comfy Stool</a>
                                        </h3>
                                        <span>$200.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix sofa bed">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products2.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Yellow Armchair</a>
                                        </h3>
                                        <span>$180.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix computer cabinet">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products3.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">White Loyal Sofa</a>
                                        </h3>
                                        <span>$170.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix desk book">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products4.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Royal Ash Sofa</a>
                                        </h3>
                                        <span>$190.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix center armchair">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products5.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Wooden Yellow Comfort</a>
                                        </h3>
                                        <span>$160.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix book sofa">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products6.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Orange Classic Sofa</a>
                                        </h3>
                                        <span>$120.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix cabinet computer">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products7.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">White Luxury Sofa</a>
                                        </h3>
                                        <span>$250.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix bed desk">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products8.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Royal Queen Black Chair</a>
                                        </h3>
                                        <span>$210.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 mix center-table cabinet">
                            <div class="products-item">
                                <div class="top">
                                    <a class="wishlist" href="#">
                                        <i class="bx bx-heart"></i>
                                    </a>
                                    <img src="{{ asset('fe/assets/images/products/products9.png') }}" alt="Products">
                                    <div class="inner">
                                        <h3>
                                            <a href="single-product.html">Four Door Wardrobe</a>
                                        </h3>
                                        <span>$220.00</span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a class="cart-text" href="#">Add To Cart</a>
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="common-btn" href="shop.html">
                            Load More Products
                            <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                            <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="buy-area">
        <div class="buy-shape">
            <img src="{{ asset('fe/assets/images/shape3.png') }}" alt="Shape">
        </div>
        <div class="container-fluid p-0">
            <div class="row m-0 align-items-center">
                <div class="col-lg-6 p-0">
                    <div class="buy-img">
                        <img src="{{ asset('fe/assets/images/buy-main1.png') }}" alt="Buy">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="buy-content ptb-100">
                        <h2>Buy Best Furniture At A Cheaper Rate</h2>
                        <p>Soft Comfy Ash Dual Sofa</p>
                        <ul>
                            <li>$160.00</li>
                            <li>
                                <del>$200.00</del>
                            </li>
                        </ul>
                        <a class="common-btn" href="shop.html">
                            Shop Now
                            <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                            <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products-area pb-70 pt-70">
        <div class="container">
            <div class="section-title">
                <h2>Best Selling Products</h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="products-item">
                        <div class="top">
                            <a class="wishlist" href="#">
                                <i class="bx bx-heart"></i>
                            </a>
                            <img src="{{ asset('fe/assets/images/products/products10.png') }}" alt="Products">
                            <div class="inner">
                                <h3>
                                    <a href="single-product.html">White Luxury Wardrobe</a>
                                </h3>
                                <span>$200.00</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="cart-text" href="#">Add To Cart</a>
                            <i class="bx bx-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="products-item">
                        <div class="top">
                            <a class="wishlist" href="#">
                                <i class="bx bx-heart"></i>
                            </a>
                            <img src="{{ asset('fe/assets/images/products/products11.png') }}" alt="Products">
                            <div class="inner">
                                <h3>
                                    <a href="single-product.html">Wooden Wardrobe</a>
                                </h3>
                                <span>$180.00</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="cart-text" href="#">Add To Cart</a>
                            <i class="bx bx-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="products-item">
                        <div class="top">
                            <a class="wishlist" href="#">
                                <i class="bx bx-heart"></i>
                            </a>
                            <img src="{{ asset('fe/assets/images/products/products12.png') }}" alt="Products">
                            <div class="inner">
                                <h3>
                                    <a href="single-product.html">Three Door Wardrobe</a>
                                </h3>
                                <span>$170.00</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="cart-text" href="#">Add To Cart</a>
                            <i class="bx bx-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="products-item">
                        <div class="top">
                            <a class="wishlist" href="#">
                                <i class="bx bx-heart"></i>
                            </a>
                            <img src="{{ asset('fe/assets/images/products/products13.png') }}" alt="Products">
                            <div class="inner">
                                <h3>
                                    <a href="single-product.html">Classic Wooden Table</a>
                                </h3>
                                <span>$190.00</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="cart-text" href="#">Add To Cart</a>
                            <i class="bx bx-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support-area pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="support-item">
                        <i class="flaticon-free-delivery"></i>
                        <h3>Free Next Day Delivery</h3>
                        <p>Lorem ipsum dolor sit amet, cons etetur sadipscing elitr</p>
                        <img src="{{ asset('fe/assets/images/support-shape1.png') }}" alt="Shape">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="support-item">
                        <i class="flaticon-call-center"></i>
                        <h3>24/7 Online Support</h3>
                        <p>Lorem ipsum dolor sit amet, cons etetur sadipscing elitr</p>
                        <img src="{{ asset('fe/assets/images/support-shape1.png') }}" alt="Shape">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="support-item">
                        <i class="flaticon-giftbox"></i>
                        <h3>Weekly Gift Voucher</h3>
                        <p>Lorem ipsum dolor sit amet, cons etetur sadipscing elitr</p>
                        <img src="{{ asset('fe/assets/images/support-shape1.png') }}" alt="Shape">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection