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

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
        </div>

    </div>
</form>

@endsection