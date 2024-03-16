@extends('layout')

@section('content')
<section class="container mt-3">
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="row mt-3">
            <h3>Препоръчани книги</h3>
            <div class="container mt-2">
              <div class="row">

              <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/IMG_20240228_114656646.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px;" alt="Книга 2">
                    <div class="card-body">
                      <h5 class="card-title">Етичният кодекс на ACM</h5>
                      <a href="documents/Code_of_Ethics_ACM.docx" class="btn btnColor">Прочети</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/do-chikago-i-nazad.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px;" alt="Книга 1">
                    <div class="card-body">
                      <h5 class="card-title">Бази от данни</h5>
                      <a href="documents/BD_Kuznecov.doc" class="btn btnColor">Прочети</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/baj_ganio.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px; " alt="Книга 3">
                    <div class="card-body">
                      <h5 class="card-title">История на информационните технологии</h5>
                      <a href="documents/Istoria_IT.doc" class="btn btnColor">Прочети</a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </section>

      <section class="container mt-5">
        <h2>Цитати на български писатели</h2>
        <div class="container mt-3">
          <div class="quote-container">
              <blockquote class="blockquote">
                  <p class="mb-0">Не се гаси туй, що не гасне</p>
                  <footer class="">- Иван Вазов</footer>
              </blockquote>
          </div>
      </div>
      <div class="container">
        <div class="quote-container">
            <blockquote class="blockquote">
                <p class="mb-0">Животът е като роман - няма смисъл без приключения.</p>
                <footer class="">- Гео Милев</footer>
            </blockquote>
        </div>
      </div>
      <!-- <div class="container">
        <div class="quote-container">
            <blockquote class="blockquote">
                <p class="mb-0">Животът е като роман - няма смисъл без приключения.</p>
                <footer class="">- Гео Милев</footer>
            </blockquote>
        </div>
      </div> -->
      <div class="container">
        <div class="quote-container">
            <blockquote class="blockquote">
                <p class="mb-0">Времето е като река – тече и не се връща.</p>
                <footer class="">- Гео Милев</footer>
            </blockquote>
        </div>
      </div>
      </section>

      <!-- <section class="container mt-5">
        <h2>Последни Новини и Обновления</h2>
      </section> -->

@endsection