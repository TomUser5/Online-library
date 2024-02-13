@extends('layout')

@section('content')
<section class="container mt-3">
        <div class="row mt-3">
            <h3>Препоръчани книги</h3>
            <div class="container mt-2">
              <div class="row">

                <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/pod-igoto.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px;" alt="Книга 1">
                    <div class="card-body">
                      <h5 class="card-title">"Под Игото"</h5>
                      <p class="card-text">„Под игото“ разказва за подготовката на Априлското въстание в едно българско градче. Започнал катo идилично описание на патриархалния бит, ритъмът бързо се сменя с появата на беглеца от Диарбекир – Иван Краличът. Той донася искрата на бунта в градчето и читателят става свидетел на възторга, обхванал колоритните му жители. Те се променят и израстват за месеци, дори за дни. Всичко има в този „най-бългаски“ роман – смях и сълзи, надежди и разочарования, герои и предатели.</p>
                      <a href="books_save/Ivan_Vazov_-_Pod_igoto_-_1773-b.pdf" class="btn btnColor">Прочети</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/do-chikago-i-nazad.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px;" alt="Книга 2">
                    <div class="card-body">
                      <h5 class="card-title">"До Чикаго и назад"</h5>
                      <p class="card-text">"До Чикаго и назад" е книга за пътуване. За осъзнаване. За прилики и разлики. За наше и чуждо. За близко и далечно, подобно и различно. За теми, които повдига единствено приключение до другия край на света.
                        Тази книга предлага на своя читател не само междуконтинентално пътешествие, но и пътуване във времето. До епоха, когато в Обетованата земя можеше да стигнеш само с кораб по океана, след като прекосиш цяла Европа.</p>
                      <a href="books_save/Aleko_Konstantinov_-_Do_Chikago_i_nazad_-_3705.pdf" class="btn btnColor">Прочети</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card book-card p-2 align-items-center">
                    <img src="/images/baj_ganio.jpg" class="card-img-top rounded-4 img-fluid" style="width: 300px; height: 420px; " alt="Книга 3">
                    <div class="card-body">
                      <h5 class="card-title">"Бай Ганьо"</h5>
                      <p class="card-text">"Помогнаха на бай Ганя да смъкне от плещите си агарянския ямурлук, наметна си той една белгийска мантия - и всички рекоха, че бай Ганьо вече е цял европеец." Така Алеко Константинов описва своя герой през 1894 г. Забавни, окарикатуряващи, философски, разказите на Алеко Константинов за бай Ганьо са едно от най-ценните съкровища на следвъзрожденската ни литература.</p>
                      <a href="books_save/Aleko_Konstantinov_-_Baj_Ganxo_-_1763-b.pdf" class="btn btnColor">Прочети</a>
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