<div class="header-section">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top-medal">
                    <div class="top-info">
                        <p><i class="flaticon-phone-call"></i> <a href="tel:924794577">0333 666 999</a></p>
                        <p><i class="flaticon-email"></i> <a href="mailto:openaivdoan@gmail.com">uocmolahinhsu@gmail.com</a>
                        </p>
                    </div>
                </div>
                <div class="header-top-right">
                    <ul class="social">
                        <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                        <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                        <li><a href="#"><i class="flaticon-skype"></i></a></li>
                        <li><a href="#"><i class="flaticon-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header-main">
        <div class="container">
            <div class="header-main-wrapper">
                <div class="header-logo">
                    <a href="{{ route('client.index') }}"><img src="{{ asset('theme/client/assets/images/logo.png') }}"
                            alt="Logo"></a>
                </div>
                <div class="header-menu d-none d-lg-block">
                    <ul class="nav-menu">
                        <li>
                            <a href="{{ route('client.index') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('client.menu') }}">Môn học</a>
                        </li>
                        <li>
                            <a href="{{ route('client.exams.index') }}">Bài kiểm tra</a>
                        </li>
                        @if (Auth::Check())
                            <li>
                                <a href="{{ route('client.customers.show') }}">Hồ sơ</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="header-sign-in-up d-none d-lg-block">
                    <ul class="nav-menu">
                        @if (!Auth::Check())
                            <li>
                                <a class="sign-in" href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li>
                                <a class="sign-up" href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        @else
                            <li>
                                <a class="sign-in" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </ul>
                </div>
                <div class="header-toggle d-lg-none">
                    <a class="menu-toggle" href="javascript:void(0)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-menu">
    <a class="menu-close" href="javascript:void(0)">
        <i class="icofont-close-line"></i>
    </a>
    <div class="mobile-top">
        <p><i class="flaticon-phone-call"></i> <a href="tel:924794577">0924 794 577</a></p>
        <p><i class="flaticon-email"></i> <a href="mailto:openaivdoan@gmail.com">openaivdoan@gmail.com</a></p>
    </div>
    <div class="mobile-sign-in-up">
        <ul>
            @if (!Auth::Check())
                <li>
                    <a class="sign-in" href="{{ route('login') }}">Đăng nhập</a>
                </li>
                <li>
                    <a class="sign-up" href="{{ route('register') }}">Đăng ký</a>
                </li>
            @else
                <li>
                    <a class="sign-in" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        Đăng xuất
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endif
        </ul>
    </div>
    <div class="mobile-menu-items">
        <ul class="nav-menu">
            <li>
                <a href="{{ route('client.index') }}">Trang chủ</a>
            </li>
            <li>
                <a href="{{ route('client.menu') }}">Môn học</a>
            </li>

            <li>
                <a href="{{ route('client.exams.index') }}">Bài kiểm tra</a>
            </li>
            @if (Auth::Check())
                <li>
                    <a href="{{ route('client.customers.show') }}">Hồ sơ</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="mobile-social">
        <ul class="social">
            <li><a href="#"><i class="flaticon-facebook"></i></a></li>
            <li><a href="#"><i class="flaticon-twitter"></i></a></li>
            <li><a href="#"><i class="flaticon-skype"></i></a></li>
            <li><a href="#"><i class="flaticon-instagram"></i></a></li>
        </ul>
    </div>
</div>
<div class="overlay"></div>