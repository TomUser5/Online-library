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
                @foreach($type_materials as $type_material)
                <option value="{{$type_material->id}}" {{ old('type_material_id') == $type_material->id ? 'selected' : '' }}>{{$type_material->type_material}}</option>
                @endforeach
            </select><br>
        </div>
        @error('type_material_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Предмет :</label><br>
            <select class="select2 form-select" name="subject_id">
                <option value="" disabled selected></option>
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
            <select class="select2 form-select" name="class_id">
                <option value="" disabled selected></option>
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
            <input class="form-control" type="file" name="document" accept=".doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, .xls, .xlsx, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .ppt, .pptx, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation">
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
            if (selectedText.trim() === "линк") {
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
</script>


<script>
    var inputNames = ['name_bg', 'name_lat', 'leaves', 'flower', 'stem', 'root', 'model_3d', 'gallery_images'];
    var selectNames = ['type_id', 'class_id', 'family_id', 'distribution_id', 'bloom_id', 'effect_id'];

    function Clear() {
        for (var i = 0; i < inputNames.length; i++) {
            document.getElementsByName(inputNames[i])[0].value = "";
            sessionStorage.removeItem(inputNames[i]);
        }

        for (var i = 0; i < selectNames.length; i++) {
            document.getElementsByName(selectNames[i])[0].selectedIndex = 0;
            sessionStorage.removeItem(selectNames[i]);
        }
    }
</script>


@endsection