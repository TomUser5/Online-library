@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('type.store') }}">
    @csrf
    <div class="d-flex flex-column">
        <div class="mb-3">
            <label class="form-label">Вид файл :</label><br>
            <input type="text" class="form-control" name="type" value="{{ old('type') }}"><br>
        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection