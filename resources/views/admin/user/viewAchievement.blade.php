@php
    use Carbon\Carbon;
@endphp

@extends('admin.layout.master')

@section('title')
    {{ $user->name }}
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $user->name }}</h4>

                @if (!$user_achievement->isEmpty())
                    <a href="{{ Route('admin.users.export.achievement', $user->id) }}" class="btn btn-primary">Export
                        achievement</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Your Achievement</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Score</th>
                                <th>Start at</th>
                                <th>Redo at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_achievement as $item)
                                <tr class="text-start">
                                    <td>{{ $item->exam->name }}</td>
                                    <td>{{ $item->score }}</td>
                                    <td>{{ Carbon::parse($item->created_at)->format('H:i d/m/Y') }}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->format('H:i d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div style="position: fixed; bottom: 1rem; right: 1rem; z-index: 999;">
            <div id="borderedToast2" class="toast toast-border-success overflow-hidden mt-3 fade show" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                <div class="toast-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <i class="ri-checkbox-circle-fill align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0"> {{ session('success') }} </h6>
                        </div>
                        <button type="button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div style="position: fixed; bottom: 1rem; right: 1rem; z-index: 999;">
            <div id="borderedToast2" class="toast toast-border-error overflow-hidden mt-3 fade show" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                <div class="toast-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <i class="ri-checkbox-circle-fill align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0"> {{ session('error') }} </h6>
                        </div>
                        <button type="button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/datatables.init.js') }}"></script>

    <!-- notifications init -->
    <script src="{{ asset('theme/admin/assets/js/pages/notifications.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        })
    </script>
@endsection
