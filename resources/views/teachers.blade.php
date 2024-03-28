@extends('layout')

@section('content')

<h1>Учители</h1>

<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Имена</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}</td>
            <td>{{ $teacher->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection