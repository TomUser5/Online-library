@extends('layout')

@section('content')

<form method="GET" action="{{ route('books.filter') }}">
<div>
    <h4>Автор:</h4>
    @foreach($authors as $author)
        <label>
            <input type="checkbox" name="authors[]" value="{{ $author->id }}" 
                {{ in_array($author->id, request('authors', [])) ? 'checked' : '' }}>
            {{ $author->first_name }} {{ $author->last_name }}
        </label><br>
    @endforeach
</div>


<div>
    <h4>Специалност:</h4>
    @foreach($subjects as $subject)
        <label>
            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" 
                {{ in_array($subject->id, request('subjects', [])) ? 'checked' : '' }}>
            {{ $subject->subject }}
        </label><br>
    @endforeach
</div>


    <div>
        <h4>Предназначено за (клас):</h4>
        @foreach($classes as $class)
            <label>
                <input type="checkbox" name="classes[]" value="{{ $class }}" 
                    {{ in_array($class, request('classes', [])) ? 'checked' : '' }}>
                {{ $class->class }} клас
            </label><br>
        @endforeach
    </div>

    <button type="submit">Филтрирай</button>
</form>


  <section class="container mt-5">
    <div class="row">
      <!-- Book Card Example -->
      @foreach($books as $book)
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{$book->title}}</h5>
            <p class="card-text">Автор: {{$book->author->first_name}} {{$book->author->last_name}} <br> Специалност: {{$book->subject->subject}} <br> Предназначено за: {{$book->class->class}} клас</p>
            <a class="btn btnColor" href="{{$book->location}}">Изтегли</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>
@endsection