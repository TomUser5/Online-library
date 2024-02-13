@extends('layout')

@section('content')

<form class="form" method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-column">
        <div class="mb-3">
            <label class="form-label">Име:</label><br>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"><br>
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Вид на материала:</label><br>
            <select class="form-select" name="type_material_id">
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
            <label class="form-label">Предмет за който се отнася материала:</label><br>
            <select class="form-select" name="subject_id">
                <option value="" disabled selected></option>
                @foreach($subjects as $subject)
                <option value="{{$subject->id}}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{$subject->subject}}</option>
                @endforeach
            </select><br>
        </div>

        @error('subjects_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Клас :</label><br>
            <select class="form-select" name="class_id">
                <option value="" disabled selected></option>
                @foreach($classes as $class)
                <option value="{{$class->id}}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{$class->class}}</option>
                @endforeach
            </select><br>
        </div>
        @error('class_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Автор:</label><br>
            <select class="form-select" name="author_id">
                <option value="" disabled selected></option>
                @foreach($authors as $author)
                <option value="{{$author->id}}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{$author->first_name}} {{$author->last_name}}</option>
                @endforeach
            </select><br>
        </div>
        @error('author_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Избери файл</label> &nbsp;
            <input class="form-control" type="file" name="document" accept=".doc, .docx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, .xls, .xlsx, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .ppt, .pptx, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation">
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

    // window.onbeforeunload = function(event) {
    //     for (var i = 0; i < inputNames.length; i++) {
    //         sessionStorage.inputNames[i] = document.getElementsByName(inputNames[i])[0].value;
    //     }
    //     for (var i = 0; i < selectNames.length; i++) {
    //         sessionStorage.selectNames[i] = document.getElementsByName(selectNames[i])[0].selectedIndex;
    //     }
    // };


    window.addEventListener('DOMContentLoaded', (event) => {
        for (var i = 0; i < inputNames.length; i++) {
            var storedValue = sessionStorage.getItem(inputNames[i]);

            if (storedValue !== null) {
                document.getElementsByName(inputNames[i])[0].value = storedValue;
            }
        }

        for (var i = 0; i < selectNames.length; i++) {
            var storedValue = sessionStorage.getItem(selectNames[i]);

            if (storedValue !== null) {
                document.getElementsByName(selectNames[i])[0].selectedIndex = storedValue;
            }
        }
    });
</script>

@endsection