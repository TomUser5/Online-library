@extends('layout')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>
    .height-select {
        scrollbar-width: none;
    }
</style>

<form class="form" method="POST" action="{{ route('material.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">
        <div>
            <label class="form-label">Име :</label><br>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"><br>
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Вид на файла :</label><br>
            <select class="select2 form-select" id="type_material" name="type_material_id">
                <option value="" disabled selected></option>
                <option value="файл">Файл</option>
                <option value="линк">Линк</option>
            </select><br>
        </div>
        @error('type_material_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Предмет :</label><br>
            <select class="form-select js-example-basic-single" name="subject_id">
                @foreach($subjects as $subject)
                <option value="{{$subject->id}}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{$subject->subject}}</option>
                @endforeach
            </select><br>
        </div>
        @error('subject_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Клас :</label><br>
            <select class="form-select js-example-basic-single" name="class_id">
                @foreach($classes as $class)
                <option value="{{$class->id}}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                    {{$class->class}}
                </option>
                @endforeach
            </select><br>
        </div>
        @error('class_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3" id="document_div">
            <label class="form-label">Избери файл</label> &nbsp;
            <input class="form-control" type="file" name="document">
        </div>
        @error('document')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div id="link_div" style="display: none;">
            <label class="form-label">Линк :</label><br>
            <input type="text" class="form-control" name="link" value="{{ old('link') }}"><br>
        </div>
        @error('link')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
            <button type="button" style="margin-right: 7%; margin-left: 5%;" class="btn btn-secondary" onclick="Clear()">Изчисти</button>
        </div>

    </div>
</form>

<script>
    $(document).ready(function() {
        $('#type_material').select2().on('change', function() {
            var selectedText = $(this).find("option:selected").text();
            if (selectedText.trim() === "Линк") {
                $('#document_div').hide();
                $('#link_div').show();
            } else {
                $('#document_div').show();
                $('#link_div').hide();
            }
        });
    });
</script>




<script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    });
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>



@endsection