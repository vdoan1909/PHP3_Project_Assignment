@extends('client.layout.master')

@section('title')
    Trang chủ
@endsection

@section('banner')
    <div class="section slider-section">
        <div class="slider-shape">
            <img class="shape-1 animation-round" src="{{ asset('theme/client/assets/images/shape/shape-8.png') }}"
                alt="Shape">
        </div>

        <div class="container">
            <div class="slider-content">
                <h4 class="sub-title">Bắt đầu với môn học yêu thích của bạn</h4>
                <h2 class="main-title">Bây giờ hãy học mọi thứ, và xây dựng <span>sự nghiệp tươi sáng</span> của bạn.</h2>
            </div>
        </div>
        <div class="slider-courses-box">

            <img class="shape-1 animation-left" src="{{ asset('theme/client/assets/images/shape/shape-5.png') }}"
                alt="Shape">

            <img class="shape-2" src="{{ asset('theme/client/assets/images/shape/shape-6.png') }}" alt="Shape">

        </div>
        <div class="slider-rating-box">
            <img class="shape animation-up" src="{{ asset('theme/client/assets/images/shape/shape-7.png') }}"
                alt="Shape">
        </div>
        <div class="slider-images">
            <div class="images">
                <img src="{{ asset('theme/client/assets/images/slider/slider-1.png') }}" alt="Slider">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="courses-top">
        <div class="section-title shape-01">
            <h2 class="main-title">Tất cả <span>Môn học</span></h2>
        </div>
        <div class="courses-search">
            <form action="{{ route('client.index') }}" method="POST">
                @csrf
                @method("GET")
                <input type="text" placeholder="Tìm kiếm môn học" name="name">
                <button type="submit">
                    <i class="flaticon-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="tab-content courses-tab-content">
        <div class="tab-pane fade show active" id="tabs1">
            <div class="courses-wrapper">
                <div class="row">
                    @foreach ($subjects as $item)
                        {{-- dung firstWhere de so sanh subject_id --}}
                        @php
                            $count = $count_res->firstWhere('subject_id', $item->id);
                        @endphp

                        <div class="col-lg-4 col-md-6">
                            <div class="single-courses">
                                <div class="courses-images">
                                    <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                        <img style="height: 260px;" src="{{ \Storage::url($item->image) }}"
                                            alt="Courses"></a>
                                </div>

                                <div class="courses-content">
                                    <h4 class="title">
                                        <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h4>

                                    <p class="description">
                                        {{ \Str::limit($item->description, 60) }}
                                    </p>

                                    <div class="courses-meta">
                                        <span>
                                            <i class="icofont-read-book"></i>
                                            <strong>{{ $count ? $count->total : 0 }} đăng ký</strong>
                                        </span>
                                    </div>

                                    <form class="mt-3" action="{{ route('client.subjects.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="subject_id" value="{{ $item->id }}">
                                        @if (Auth::User())
                                            <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="courses-btn text-center">
        <a href="{{ route('client.menu') }}" class="btn btn-secondary btn-hover-primary">Tất cả môn học</a>
    </div>
@endsection

@section('toast')
    @if (session('user_subject_success'))
        <script>
            window.onload = function() {
                swal("Chúc mừng!", "{{ session('user_subject_success') }}", "success");
            };
        </script>

        @php
            Session::forget('user_subject_success');
        @endphp
    @endif

    @if (session('user_subject_warning'))
        <script>
            window.onload = function() {
                swal("Tiếc quá!", "{{ session('user_subject_warning') }}", "warning");
            };
        </script>
        @php
            Session::forget('user_subject_warning');
        @endphp
    @endif

    @if (session('user_subject_error'))
        <script>
            window.onload = function() {
                swal("Rất tiếc!", "{{ session('user_subject_error') }}", "error");
            };
        </script>
        @php
            Session::forget('user_subject_error');
        @endphp
    @endif
@endsection
