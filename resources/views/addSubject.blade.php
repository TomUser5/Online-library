@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">
        <div class="mb-3">
            <label class="form-label">Име на учебения предмет :</label><br>
            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"><br>
        </div>
        @error('subject')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
            <button type="button" style="margin-right: 7%; margin-left: 5%;" class="btn btn-secondary" onclick="Clear()">Изчисти</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        @endsection