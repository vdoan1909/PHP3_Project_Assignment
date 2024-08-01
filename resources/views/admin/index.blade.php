@extends('admin.layout.master')

@section('title')
    Dashboard
@endsection

@section('style-libs')
@endsection

@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Chào, {{ Auth::User()->name }}!</h4>
                                <p class="text-muted mb-0">Đây là những gì đang xảy ra với cửa hàng của bạn
                                    hôm nay.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Môn học</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $count_subject }}">{{ $count_subject }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Bài kiểm tra</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $count_exam }}">{{ $count_exam }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->   
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Học sinh</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $count_customer }}">{{ $count_customer }}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Môn học</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                        <tbody>
                                            @foreach ($subjects as $subject)
                                                @php
                                                    $subject_count_res = $count_res ?? collect();
                                                    $subject_count_exam = $count_subject_exam ?? collect();

                                                    $subject_count_res = $count_res->firstWhere(
                                                        'subject_id',
                                                        $subject->id,
                                                    );
                                                    $subject_count_exam = $count_subject_exam->firstWhere(
                                                        'id',
                                                        $subject->id,
                                                    );
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="{{ \Storage::url($subject->image) }}"
                                                                    alt="" class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1">
                                                                    <a href="#" class="text-reset">
                                                                        {{ $subject->name }}
                                                                    </a>
                                                                </h5>
                                                                <span class="text-muted">
                                                                    {{ $subject->created_at }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">
                                                            {{ $subject_count_res ? $subject_count_res->total : 0 }}
                                                        </h5>
                                                        <span class="text-muted">Lượt đăng ký</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">
                                                            {{ $subject_count_exam ? $subject_count_exam->exams_count : 0 }}
                                                        </h5>
                                                        <span class="text-muted">Số bài kiểm tra</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Bài kiểm tra</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                        <tbody>
                                            @foreach ($exams as $exam)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <h5 class="fs-14 my-1 fw-medium">
                                                                    <a href="#" class="text-reset">
                                                                        {{ $exam->name }}
                                                                    </a>
                                                                </h5>
                                                                <span class="text-muted">
                                                                    {{ $exam->subject->name }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">
                                                            {{ $exam->number_of_questions }}
                                                        </p>
                                                        <span class="text-muted">Số câu hỏi</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">
                                                            {{ $exam->time_limit}}
                                                        </p>
                                                        <span class="text-muted">Thời gian</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">
                                                            {{ $count_user_exam[$exam->id] ?? 0 }}
                                                        </p>
                                                        <span class="text-muted">Người làm</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script-libs')
    <!-- apexcharts -->
    <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection
