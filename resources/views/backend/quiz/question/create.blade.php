@extends('backend.layouts.app')
@section('title', 'Add Question')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('public/vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('public/vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Question</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('question.index')}}">Questions</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('question.create')}}">Add Question</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('question.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Quiz</label>
                                        <select class="form-control" name="quizId">
                                            @forelse ($short_answer as $q)
                                            <option value="{{$q->id}}" {{old('quizId')==$q->id?'selected':''}}>
                                                {{$q->quizTitle}}</option>
                                            @empty
                                            <option value="">No Quiz Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has('quizId'))
                                    <span class="text-danger"> {{ $errors->first('quizId') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Question Type</label>
                                        <select class="form-control" name="questionType">
                                            <option value="multiple_choice" @if(old('questionType')=='multiple_choice' ) selected @endif>
                                                Multiple Choice
                                            </option>
                                            <option value="true_false" @if(old('questionType')=='true_false' ) selected
                                                @endif>True False
                                            </option>
                                            <option value="short_answer" @if(old('questionType')=='short_answer' ) selected @endif>Short Answer
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Question Content</label>
                                        <textarea class="form-control"
                                            name="questionContent">{{old('questionContent')}}</textarea>
                                    </div>
                                    @if($errors->has('questionContent'))
                                    <span class="text-danger"> {{ $errors->first('questionContent') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-light">Cencel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('public/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('public/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('public/vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('public/js/plugins-init/pickadate-init.js')}}"></script>
@endpush