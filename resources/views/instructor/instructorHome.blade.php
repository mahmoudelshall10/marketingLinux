@extends('instructor.layouts.auth')
@section('content')
@push('css')
    <link href="{{ asset('css/modal-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/spinner-style.css') }}" rel="stylesheet">
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                Hi there, awesome instructor
            </div>
        </div>
            @if (!$instructor)
                @include('instructor.instructorQuestions')
            @endif
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/modal-script.js') }}"></script>
@endpush
@endsection

