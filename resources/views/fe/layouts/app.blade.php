<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from templates.hibootstrap.com/ecop/default/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 15:25:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('fe.layouts.components.header-css')
</head>
<body>

<div class="loader">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="pre-load">
                <div class="inner one"></div>
                <div class="inner two"></div>
                <div class="inner three"></div>
            </div>
        </div>
    </div>
</div>


<div class="header-area">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 col-lg-7">
                <div class="left">
                    <ul>
                        <li>
                            <i class="flaticon-delivery-truck"></i>
                            <span>Free Next Day Delivery*</span>
                        </li>
                        <li>
                            <i class="flaticon-quality"></i>
                            <span>Best Price Guarantee</span>
                        </li>
                        <li>
                            <i class="flaticon-call-center"></i>
                            <span>24/7 Customer Support</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5">
                <div class="right">
                    <div class="inner">
                    </div>
                    <div class="inner">
                        <div class="call">
                            <i class="flaticon-phone-call"></i>
                            <a href="tel:0999999999">0999999999</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="nav-top-area">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="left">
                    <a href="index.html">
                        <img src="{{ asset('fe/assets/images/logo.png') }}" alt="Logo" class="img-logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="middle">
                    <form>
                        <div class="form-group">
                            <div class="inner">
                                <select>
                                    <option>All Categories</option>
                                    <option>Chair</option>
                                    <option>Table</option>
                                    <option>Bed</option>
                                    <option>Sofa</option>
                                    <option>Headphones</option>
                                    <option>Keyboard</option>
                                    <option>MacBook</option>
                                    <option>Vegetable</option>
                                    <option>Fruits</option>
                                    <option>Chicken</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" placeholder="Search Your Keywords">
                            <button type="submit" class="btn">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="right">
                    <ul>
                        <li>
                        </li>
                        <li>
                            <button type="button" class="btn wishlist cart-popup-btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <i class="bx bxs-cart"></i>
                                <span>2</span>
                            </button>
                        </li>
                        <li id="myLoginLinkLi">
                            <a class="join" onclick="join()">
                                <i class="flaticon-round-account-button-with-user-inside"></i>
                                Join
                            </a>
                        </li>
                        <li id="myAccountLinkLi" class=" navbar navbar-expand-lg navbar-light bg-light" >
                            <a class="join nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span id="userName"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" onclick="orderlist()">Order List</a>
                                <a class="dropdown-item" onclick="logout()">Logout</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script>
    const token = localStorage.getItem('token');
    const userData = JSON.parse(localStorage.getItem('user'));

    if (token) {
        document.getElementById('myLoginLinkLi').style.display = 'none';
        const userData = JSON.parse(localStorage.getItem('user'));
        const userName = userData.name;
        const userNameElement = document.getElementById('userName');
        userNameElement.textContent = userName;
    } else {
        document.getElementById('myAccountLinkLi').style.display = 'none';
    }

    function logout() {
        const token = localStorage.getItem('token');

        fetch('http://127.0.0.1:8000/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
            },
        })
            .then(data => {
                localStorage.removeItem('token');
                localStorage.removeItem('user');

                window.location.href = '/';
            })
            .catch(error => {
                localStorage.removeItem('token');
                localStorage.removeItem('user');

                window.location.href = '/';
            });
    }
    function join(){
        window.location.href = '/login';
    }
    function orderlist(){
        window.location.href = '/listorder';
    }
</script>
{{--Navbar--}}
@include('fe.layouts.components.navbar')
{{--End navbar--}}

{{--Banner--}}
@yield('banner')
{{--End Banner--}}

<div class="main-content">

    @yield('content')

</div>

<footer class="footer-area pt-100 pb-70 bg-ft">
    <div class="footer-shape">
        <img src="{{ asset('fe/assets/images/footer-right-shape.png') }}" alt="Shape">
        <img src="{{ asset('fe/assets/images/shape5.png') }}" alt="Shape">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-logo">
                        <a class="logo" href="index.html">
                            <img class="img-logo" src="{{ asset('fe/assets/images/logo.png') }}" alt="Logo">
                        </a>
                        <ul>
                            <li>
                                <i class="flaticon-pin"></i>
                                <a href="#">2750 Quadra Street, Victoria, Canada</a>
                                <a href="#">345-659 Birmingham Street, England</a>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <a href="tel:9908314326">+990-831-4326</a>
                                <a href="tel:5465486325">+546-548-6325</a>
                            </li>
                            <li>
                                <i class="flaticon-email"></i>
                                <a href="https://templates.hibootstrap.com/cdn-cgi/l/email-protection#eb838e878784ab8e88849bc5888486"><span
                                        class="__cf_email__" data-cfemail="244c4148484b6441474b540a474b49">[email&#160;protected]</span></a>
                                <a href="https://templates.hibootstrap.com/cdn-cgi/l/email-protection#c5acaba3aa85a0a6aab5eba6aaa8"><span
                                        class="__cf_email__" data-cfemail="4f262129200f2a2c203f612c2022">[email&#160;protected]</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-services">
                        <h3>Customer Services</h3>
                        <ul>
                            <li>
                                <a href="return-policy.html">Return Policy</a>
                            </li>
                            <li>
                                <a href="faq.html">FAQ</a>
                            </li>
                            <li>
                                <a href="single-product.html">Single Product</a>
                            </li>
                            <li>
                                <a href="order-tracking.html">Order Tracking</a>
                            </li>
                            <li>
                                <a href="privacy-policy.html">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="footer-item">
                    <div class="footer-links">
                        <h3>Important Links</h3>
                        <div class="row">
                            <div class="col-6 col-sm-8 col-lg-8">
                                <ul>
                                    <li>
                                        <a href="about.html">About Us</a>
                                    </li>
                                    <li>
                                        <a href="blog.html">Blog</a>
                                    </li>
                                    <li>
                                        <a href="#">Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="#">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="shop.html">Shop</a>
                                    </li>
                                    <li>
                                        <a href="login.html">My Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-4">
                                <ul>
                                    <li>
                                        <a href="#">Cameras</a>
                                    </li>
                                    <li>
                                        <a href="#">Laptops</a>
                                    </li>
                                    <li>
                                        <a href="#">Headphones</a>
                                    </li>
                                    <li>
                                        <a href="#">Smartwatch</a>
                                    </li>
                                    <li>
                                        <a href="#">Microphones</a>
                                    </li>
                                    <li>
                                        <a href="#">Computers</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 col-lg-6">
                <div class="payment-cards">
                    <ul>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('fe/assets/images/payment1.png') }}" alt="Payment">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('fe/assets/images/payment2.png') }}" alt="Payment">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('fe/assets/images/payment3.png') }}" alt="Payment">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('fe/assets/images/payment4.png') }}" alt="Payment">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="social-links">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="bx bxl-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/" target="_blank">
                                <i class="bx bxl-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/" target="_blank">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.skype.com/" target="_blank">
                                <i class="bx bxl-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/" target="_blank">
                                <i class="bx bxl-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="copyright-area">
    <div class="container">
        <div class="copyright-item">
            <p>© Ecop is Proudly Owned by <a href="https://hibootstrap.com/" target="_blank">HiBootstrap</a></p>
        </div>
    </div>
</div>


<div class="modal fade modal-right popup-modal" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Shopping Cart <span>02 Items</span></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart-table">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('fe/assets/images/cart/cart1.png') }}" alt="Cart">
                            </th>
                            <td>
                                <h3>White Comfy Stool</h3>
                                <span class="rate">$200.00 x 1</span>
                            </td>
                            <td>
                                <ul class="number">
                                    <li>
                                        <span class="minus">-</span>
                                        <input type="text" value="1"/>
                                        <span class="plus">+</span>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a class="close" href="#">
                                    <i class="bx bx-x"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('fe/assets/images/cart/cart2.png') }}" alt="Cart">
                            </th>
                            <td>
                                <h3>Yellow Armchair</h3>
                                <span class="rate">$180.00 x 1</span>
                            </td>
                            <td>
                                <ul class="number">
                                    <li>
                                        <span class="minus">-</span>
                                        <input type="text" value="1"/>
                                        <span class="plus">+</span>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a class="close" href="#">
                                    <i class="bx bx-x"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="total-amount">
                        <h3>Total: <span>$380.00</span></h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form>
                    <button type="submit" class="btn common-btn">
                        Proceed To Checkout
                        <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                        <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-right popup-modal wishlist-modal" id="exampleModalWishlist" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog" style="margin-right: 15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Wishlist <span>02 Items</span></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart-table">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('fe/assets/images/cart/cart1.png') }}" alt="Cart">
                            </th>
                            <td>
                                <h3>White Comfy Stool</h3>
                                <span class="rate">$200.00 x 1</span>
                            </td>
                            <td>
                                <a class="common-btn" href="shop.html">
                                    Add To Cart
                                    <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                                </a>
                            </td>
                            <td>
                                <a class="close" href="#">
                                    <i class="bx bx-x"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('fe/assets/images/cart/cart2.png') }}" alt="Cart">
                            </th>
                            <td>
                                <h3>Yellow Armchair</h3>
                                <span class="rate">$180.00 x 1</span>
                            </td>
                            <td>
                                <a class="common-btn" href="shop.html">
                                    Add To Cart
                                    <img src="{{ asset('fe/assets/images/shape1.png') }}" alt="Shape">
                                    <img src="{{ asset('fe/assets/images/shape2.png') }}" alt="Shape">
                                </a>
                            </td>
                            <td>
                                <a class="close" href="#">
                                    <i class="bx bx-x"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="go-top">
    <i class="bx bxs-up-arrow-circle"></i>
    <i class="bx bxs-up-arrow-circle"></i>
</div>

@include('fe.layouts.components.footer-js')

</body>

<!-- Mirrored from templates.hibootstrap.com/ecop/default/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 15:25:33 GMT -->
</html>
