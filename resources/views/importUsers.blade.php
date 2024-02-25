@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('user.import') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">
        @if (Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="mb-3">
            <label class="form-label">Избери файл</label> &nbsp;
            <input class="form-control" type="file" name="document" accept=".xlsx, .xlsm, .xlsb, .xltx, .xltm, .xls, .xlt, .xls, .xml, .xml, .xlam, .xla, .xlw, .xlr">
        </div>
        @error('document')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating pt-2">Файлът трябва да е excel таблица, като подредбата на колоните трябва да е следната: <table class="border-secondary table-bordered"> <tr> <th class="p-2">Собствено име</th> <th class="p-2">Бащино име</th> <th class="p-2">Фамилия</th> <th class="p-2">Email</th> <th class="p-2">Клас</th> </tr> </table> <div>

        <div class="pt-4" style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
        </div>

    </div>
</form>

@endsection