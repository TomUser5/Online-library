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
        margin-top: 10px;
    }
</style>
    <div class="container">
        <h2 class="mt-3 mb-4">Материали за {{$class}} клас:</h2>

        <div class="material-section">
            @foreach($materials as $material)
            <div class="material-item">
                @php
                $filePath = $material->location;
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                @endphp
                <h4>{{ $material->title }}</h4>
                <p>Разширение: {{$fileExtension}}</p>
                <a class="file-link btn btnColor" href="/{{$material->location}}" download>Изтегли</a>
            </div>
            @endforeach
        </div>
    </div>
    @endsection