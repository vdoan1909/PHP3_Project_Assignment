@extends('client.layout.master')

@section('title')
    {{ $subject->name }}
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
    <div class="row gx-10">
        <div class="col-lg-8">
            <div class="courses-details">
                <div class="courses-details-images">
                    <img src="{{ Storage::url($subject->image) }}" alt="Courses Details">
                    <span class="tags">{{ $subject->name }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="sidebar">
                <div class="sidebar-widget widget-information">
                    <div class="info-price">
                        <p class="text-start">{{ Str::limit($subject->description, 369) }}</p>
                    </div>
                    <form class="info-btn mt-3" action="{{ route('client.subjects.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        @if (Auth::User())
                            <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                        @endif
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                        <a href="{{ route('client.exams.examBySubject', $subject->slug) }}" class="btn btn-primary mt-2">Làm bài kiểm tra</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
