@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('author.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">
        <div class="mb-3">
            <label class="form-label">Собствено име :</label><br>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"><br>
        </div>
        @error('first_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Фамилия:</label><br>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"><br>
        </div>
        @error('last_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
            <button type="button" style="margin-right: 7%; margin-left: 5%;" class="btn btn-secondary" onclick="Clear()">Изчисти</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection