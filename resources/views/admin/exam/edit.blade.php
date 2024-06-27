@extends('admin.layout.master')

@section('title')
    Edit Exam {{ $exam->name }}
@endsection

@section('style-libs')
@endsection

@section('content')
    <form class="form-group" action="{{ route('admin.exams.update', $exam->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Exam {{ $exam->name }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Details</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $exam->name }}">
                                        @error('name')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="time_limit" class="form-label">Time limit</label>
                                        <select class="form-select" id="time_limit" name="time_limit">
                                            <option value="{{ $exam->time_limit }}">
                                                {{ $exam->time_limit }}
                                            </option>

                                            @if ($exam->time_limit != 15)
                                                <option value="15">15 Minutes</option>
                                            @endif

                                            @if ($exam->time_limit != 45)
                                                <option value="45">45 Minutes</option>
                                            @endif

                                            @if ($exam->time_limit != 60)
                                                <option value="60">60 Minutes</option>
                                            @endif

                                            @if ($exam->time_limit != 90)
                                                <option value="90">90 Minutes</option>
                                            @endif

                                            @if ($exam->time_limit != 120)
                                                <option value="120">120 Minutes</option>
                                            @endif
                                        </select>
                                        @error('time_limit')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="number_of_questions" class="form-label">Number of question</label>
                                        <input type="number" class="form-control" id="number_of_questions"
                                            name="number_of_questions" value="{{ $exam->number_of_questions }}">
                                        @error('number_of_questions')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="subject_id" class="form-label">Subject</label>
                                        <select class="form-select" id="subject_id" name="subject_id">
                                            @foreach ($subjects as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id === $exam->subject->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="13" name="description">
                                            {{ $exam->description }}
                                        </textarea>
                                        @error('description')
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
