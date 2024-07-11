@extends('client.layout.master')

@section('title')
    Danh sách môn học
@endsection

@section('banner')
    <div class="section page-banner">
        <img class="shape-1 animation-round" src="{{ asset('theme/client/assets/images/shape/shape-8.png') }}" alt="Shape">
        <img class="shape-2" src="{{ asset('theme/client/assets/images/shape/shape-23.png') }}" alt="Shape">
        <div class="container">
            <div class="page-banner-content">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Subject Details</li>
                </ul>
                <h2 class="title">Subject <span> Details</span></h2>
            </div>
        </div>
        <div class="shape-icon-box">
            <img class="icon-shape-1 animation-left" src="{{ asset('theme/client/assets/images/shape/shape-5.png') }}"
                alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-badge"></i>
                </div>
            </div>
            <img class="icon-shape-2" src="{{ asset('theme/client/assets/images/shape/shape-6.png') }}" alt="Shape">
        </div>
        <img class="shape-3" src="{{ asset('theme/client/assets/images/shape/shape-24.png') }}" alt="Shape">
        <img class="shape-author" src="{{ asset('theme/client/assets/images/author/author-11.jpg') }}" alt="Shape">
    </div>
@endsection

@section('content')
    <form class="courses-search search-2" action="{{ route('client.menu') }}" method="GET">
        @csrf
        <input type="text" placeholder="Tìm kiếm môn học" name="name">
        <button type="submit"><i class="icofont-search"></i></button>
    </form>

    <div class="courses-wrapper-02 mb-5">
        <div class="row">
            @foreach ($subjects as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-courses">
                        <div class="courses-images">
                            <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                <img style="height: 260px;" src="{{ \Storage::url($item->image) }}" alt="Courses"></a>
                        </div>
                        <div class="courses-content">
                            <h4 class="title">
                                <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                    {{ $item->name }}
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (
        $subjects instanceof Illuminate\Pagination\LengthAwarePaginator ||
            $subjects instanceof Illuminate\Pagination\Paginator)
        {{ $subjects->links() }}
    @endif
@endsection
