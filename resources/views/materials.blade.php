@extends('layout')

@section('content')

<style>
    .container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .material-section {
        margin-bottom: 30px;
    }

    .material-item {
        background-color: #e6e6e6;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        transition: box-shadow 0.3s ease-in-out;
    }

    .material-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .file-link {
        display: inline-block;
    }
</style>
<div class="container">
    <h2 class="mt-3 mb-4">Материали за {{$class}} клас:</h2>

    <div class="material-section">
        @foreach($materials as $material)

        @php
        $filePath = $material->location;
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $startsWithD = (substr($filePath, 0, 1) === 'd');
        @endphp

        @if($startsWithD)
        <div class="material-item">
            <h4>{{ $material->title }}</h4>
            <!-- <p>Вид: {{$fileExtension}}</p> -->
            <p>Вид: {{$material->type_material->type_material}}</p>
            <div class="d-flex flex-row mt-4">
                <a class="btn btnColor" href="/{{$material->location}}" download>Изтегли</a>

                @if(\App\Models\Admin::where('user_id', Auth::user()->id)->exists() || \App\Models\Teacher::where('user_id', Auth::user()->id)->exists())
                <form action="{{ route('material.delete', $material->id) }}" class="ms-4" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Изтриване</button>
                </form>
                @endif

            </div>
        </div>
        @else
        <div class="material-item">
            <a href="{{$material->location}}" target=”_blank”><h4>{{ $material->title }}</h4></a>
            <p>Вид: {{$material->type_material->type_material}}</p>
            <div class="d-flex flex-row mt-4">
                @if(\App\Models\Admin::where('user_id', Auth::user()->id)->exists() || \App\Models\Teacher::where('user_id', Auth::user()->id)->exists())
                <form action="{{ route('material.delete', $material->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Изтриване</button>
                </form>
                @endif

            </div>
        </div>
        @endif

        @endforeach

    </div>
</div>
@endsection