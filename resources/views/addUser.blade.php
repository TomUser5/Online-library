@extends('layout')

@section('content')

<style>
    /* body {
        background-color: #e6e6e6;
    } */
</style>

<form class="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
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
            <label class="form-label">Бащино име :</label><br>
            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}"><br>
        </div>
        @error('middle_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Фамилия :</label><br>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"><br>
        </div>
        @error('last_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Email :</label><br>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}"><br>
        </div>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-check">
            <input class="form-check-input" type="radio" name="user_role" value="flexRadioStudent" id="flexRadioStudent">
            <label class="form-check-label" for="flexRadioStudent">
                Ученик
            </label>
        </div>

        @php
        use App\Models\Admin;
        @endphp
        @if(Admin::where('user_id', Auth::user()->id)->exists())
        <div class="form-check">
            <input class="form-check-input" type="radio" name="user_role" value="flexRadioTeacher" id="flexRadioTeacher">
            <label class="form-check-label" for="flexRadioTeacher">
                Учител
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="user_role" value="flexRadioAdmin" id="flexRadioAdmin">
            <label class="form-check-label" for="flexRadioAdmin">
                Администратор
            </label>
        </div>
        @endif
        <br>
        @error('user_role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- Content sections -->
        @error('class_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="student-content role-content" style="display:none;">
            <div class="mb-3">
                <label class="form-label">Клас на ученика :</label><br>
                <select class="form-select" name="class_id">
                    <option value="" disabled selected></option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{$class->class}}</option>
                    @endforeach
                </select><br>
            </div>
        </div>

        <div class="teacher-content role-content" style="display:none;">
        <div class="mb-3">
                <label class="form-label">Преподава по :</label><br>
                <select class="form-select" name="subject_id">
                    <option value="" disabled selected></option>
                    @foreach($subjects as $subject)
                    <option value="{{$subject->id}}" {{ old('subject') == $subject->id ? 'selected' : '' }}>{{$subject->subject}}</option>
                    @endforeach
                </select><br>
            </div>
        </div>

        <div style="width:100%;">
            <button type="submit" class="btn btnColor">Добави</button>
            <button type="button" style="margin-right: 7%; margin-left: 5%;" class="btn btn-secondary" onclick="Clear()">Изчисти</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                updateContentVisibility();

                $('input[name="user_role"]').change(function() {
                    updateContentVisibility();
                });

                function updateContentVisibility() {
                    var selectedRole = $('input[name="user_role"]:checked').val();

                    $('.role-content').hide();

                    if (selectedRole === 'flexRadioStudent') {
                        $('.student-content').show();
                    } else if (selectedRole === 'flexRadioTeacher') {
                        $('.teacher-content').show();
                    } else if (selectedRole === 'flexRadioAdmin') {
                        $('.admin-content').show();
                    }
                }
            });
        </script>


        @endsection