@extends('layout')

@section('content')

<h1>Ученици в {{ $class }} клас</h1>

<br>

@if($students->isEmpty())
<p>Няма ученици в този клас</p>
@else

<table class="table">
    <thead>
        <tr>
            <th scope="col">Имена</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <form action="{{ route('user.delete', $student->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Изтриване</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection