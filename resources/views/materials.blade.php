@extends('layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .container {
        background-color: #f2f2f2;
        border-radius: 8px;
        box-shadow: 0 4px 40px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .searchBar {
        background-color: #f2f2f2;
        border-radius: 8px;
        box-shadow: 0 4px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
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
    .highlight {
    background-color: yellow;
    }
</style>
<div class="container">

<?php
$lastChar = substr($class, 1);
$firstChar = substr($class, 0, 1);
$specificClass = 58;

if ($lastChar === 'а') {
    $specificClass = "приложно програмиране";
} elseif ($lastChar === 'б') {
    $specificClass = "софтуерни и хардуерни науки";
} elseif ($lastChar === 'в') {
    $specificClass = "природни науки – биология";
}
?>


    <h2 class="mt-3 mb-4">Материали за {{$firstChar}} клас {{$specificClass}}:</h2>

    <div class="material-section">
    <div class="searchBar" style="background-color: #e6e6e6;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="articleTitleSection" id="no-results" style="display: none;">
                <div class="empty-state text-center">
                    <img src="/images/no-results.png" alt="Няма намерени резултати" class="empty-state-image">
                    <h3 class="empty-state-heading">Няма намерени резултати</h3>
                    <p class="empty-state-text">Не успяхме да намерим резултати за вашето търсене. Моля, опитайте отново с различни ключови думи.</p>
                </div>
            </div>
            <div class="articleTitleSection centerSearchBar">
                <form method="POST" action="{{ route('search') }}" class="d-flex">
                    @csrf
                    <input type="text" class="form-control" placeholder="Търси..." name="search" id="searchInput" value="@isset($searchedWord) {{ $searchedWord }} @endisset">
                    <input style="display:none;" name="class" value="{{$class}}">
                    <button type="submit" class="btn btnColor ms-2"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

        @foreach($materials as $material)

        @php
        $filePath = $material->location;
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $startsWithD = (substr($filePath, 0, 1) === 'd');
        @endphp

        @if($startsWithD)
        <div class="material-item">

            <h4> @isset($searchedWord) {!! preg_replace('/('. preg_quote($searchedWord, '/') .')/iu', '<span id="first-found" class="highlight">$0</span>', $material->title) !!} @else {{ $material->title }} @endif</h4>
            <!-- <p>Вид: {{$fileExtension}}</p> -->
            <p>Вид: @isset($searchedWord) {!! preg_replace('/('. preg_quote($searchedWord, '/') .')/iu', '<span id="first-found" class="highlight">$0</span>', $material->type_material->type_material) !!} @else {{$material->type_material->type_material}} @endif</p>
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
            <a href="{{$material->location}}" target=”_blank”><h4>@isset($searchedWord) {!! preg_replace('/('. preg_quote($searchedWord, '/') .')/iu', '<span id="first-found" class="highlight">$0</span>', $material->title) !!} @else {{ $material->title }} @endif</h4></a>
            <p>Вид: @isset($searchedWord) {!! preg_replace('/('. preg_quote($searchedWord, '/') .')/iu', '<span id="first-found" class="highlight">$0</span>', $material->type_material->type_material) !!} @else {{$material->type_material->type_material}} @endif</p>
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

@isset($searchedWord)

<script>
    var highlightedElements = document.querySelectorAll('.highlight');

    if (highlightedElements.length == 0) {
        document.getElementById("no-results").style.display = "block";
    }
</script>

<script>
    // Find the first element with class "highlight"
    var firstFoundElement = document.querySelector('.highlight');

    if (firstFoundElement) {
        // Get the position of the element
        var elementPosition = firstFoundElement.getBoundingClientRect().top;

        // Scroll the page to the position of the element minus 20 pixels
        window.scrollTo({
            top: elementPosition - 80,
            behavior: "smooth"
        });
    }
</script>
@endisset

@endsection