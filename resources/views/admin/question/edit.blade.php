@extends('admin.layout.master')

@section('title')
    Edit Question {{ $question->name }}
@endsection

@section('style-libs')
@endsection

@section('content')
    <form class="form-group" action="{{ route('admin.questions.update', $question->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Question {{ $question->name }}</h4>
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
                                <div class="col-md-6">
                                    <div>
                                        <label for="name" class="form-label">Question</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $question->name }}">
                                        @error('name')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label for="exam_id" class="form-label">Exam</label>
                                        <select class="form-select" id="exam_id" name="exam_id">
                                            @foreach ($exam as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id === $question->exam->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('exam_id ')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label for="option_a" class="form-label">Answer A</label>
                                        <input type="text" class="form-control" id="option_a" name="option_a"
                                            value="{{ $question->option_a }}">
                                        @error('option_a')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label for="option_b" class="form-label">Exam</label>
                                        <input type="text" class="form-control" id="option_b" name="option_b"
                                            value="{{ $question->option_b }}">
                                        @error('option_b')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label for="option_c" class="form-label">Exam</label>
                                        <input type="text" class="form-control" id="option_c" name="option_c"
                                            value="{{ $question->option_c }}">
                                        @error('option_c')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <label for="option_d" class="form-label">Exam</label>
                                        <input type="text" class="form-control" id="option_d" name="option_d"
                                            value="{{ $question->option_d }}">
                                        @error('option_d')
                                            <p class="mt-2 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div>
                                        <label for="correct_answer" class="form-label">Correct Answer</label>
                                        <select class="form-select" id="correct_answer" name="correct_answer">
                                            <option value="{{ $question->correct_answer }}">
                                                {{ $question->correct_answer }}
                                            </option>

                                            @if ($question->correct_answer != 'A')
                                                <option value="A">A</option>
                                            @endif

                                            @if ($question->correct_answer != 'B')
                                                <option value="B">B</option>
                                            @endif

                                            @if ($question->correct_answer != 'C')
                                                <option value="C">C</option>
                                            @endif

                                            @if ($question->correct_answer != 'D')
                                                <option value="D">D</option>
                                            @endif
                                        </select>
                                        @error('correct_answer')
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
