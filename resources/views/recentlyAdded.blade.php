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

<section class="container mt-5">

    <div class="row">
        <div class="col">
            <h2 class="mt-3 mb-4">Материали:</h2>

            <div class="material-section">
                @foreach($materials as $material)
                <div class="material-item">
                    @php
                    $filePath = $material->location;
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                    @endphp
                    <h4>{{ $material->title }}</h4>
                    <p>Разширение: {{$fileExtension}} <br> Добавен {{ $material->timeDifference }}</p>
                    <a class="file-link btn btnColor" href="{{$material->location}}" download>Изтегли</a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col">
            <h2 class="mt-3 mb-4">Книги:</h2>

            <div class="material-section">
            @foreach($books as $book)
                <div class="material-item">
                    <h4>{{$book->title}}</h4>
                    <p>Автор: {{$book->author->first_name}} {{$book->author->last_name}} <br> Специалност: {{$book->subject->subject}} <br> Добавена {{ $book->timeDifference }}</p>
                    <a class="file-link btn btnColor" href="{{$book->location}}" download>Изтегли</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>

@endsection