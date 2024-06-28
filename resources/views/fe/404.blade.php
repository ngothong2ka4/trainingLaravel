@include('fe.layouts.components.header-css')
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


<div class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <i class="bx bxs-sad bx-flashing"></i>
                    <h1>Sorry!</h1>
                    <h2>Here Is Some Problem</h2>
                    <p>The page you are looking for it maybe deleted</p>
                    <a class="common-btn" href="{{ route('homePage') }}">
                        Go To Home
                        <img src="{{ asset('fe/assets/images/shape1.png' )}}" alt="Shape">
                        <img src="{{ asset('fe/assets/images/shape2.png' )}}" alt="Shape">
                    </a>
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
