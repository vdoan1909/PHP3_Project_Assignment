@extends('admin.layout.master')

@section('title')
    Import Question
@endsection

@section('style-libs')
@endsection

@section('content')
    <form class="form-group" action="{{ route('admin.questions.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Import Question</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">

                                    <div class="mt-3">
                                        <label for="exam_id" class="form-label">Subject</label>
                                        <select class="form-select" id="exam_id" name="exam_id">
                                            @foreach ($exams as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('exam_id')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="image" class="form-label">File Excel</label>
                                        <input type="file" class="form-control" id="image" name="import_file">
                                        @error('import_file')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

@section('script-libs')
    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
@endsection
