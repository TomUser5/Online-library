@extends('layout')

@section('content')

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