@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('user.import') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">

        <div class="mb-3">
            <label class="form-label">Избери файл</label> &nbsp;
            <input class="form-control" type="file" name="document" accept=".xlsx, .xlsm, .xlsb, .xltx, .xltm, .xls, .xlt, .xls, .xml, .xml, .xlam, .xla, .xlw, .xlr">
        </div>
        @error('document')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
            <button type="button" style="margin-right: 7%; margin-left: 5%;" class="btn btn-secondary" onclick="Clear()">Изчисти</button>
        </div>

    </div>
</form>

@endsection