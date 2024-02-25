<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STEM.lib</title>
  <link rel="icon" type="image/x-icon" href="https://img.icons8.com/external-vitaliy-gorbachev-lineal-color-vitaly-gorbachev/60/external-online-library-online-learning-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Add your custom styles here */
    body {
      margin: 0;
      padding: 0;
    }

    .sticky-sidebar {
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      /* Add this to enable scrolling within the sidebar */
    }

    /* Adjust the width as needed */
    .content-container {
      width: 100%;
      /* Remove the margin for smaller screens */
    }

    .background {
      background: #404040 !important;
    }

    .activePage {
      background-color: #202020;
    }

    .btnColor {
      --bs-btn-color: #fff;
      --bs-btn-bg: #333333;
      --bs-btn-border-color: #333333;
      --bs-btn-hover-color: #fff;
      --bs-btn-hover-bg: #333333;
      --bs-btn-hover-border-color: #333333;
      --bs-btn-focus-shadow-rgb: 49, 132, 253;
      --bs-btn-active-color: #fff;
      --bs-btn-active-bg: #333333;
      --bs-btn-active-border-color: #333333;
      --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      --bs-btn-disabled-color: #fff;
      --bs-btn-disabled-bg: #333333;
      --bs-btn-disabled-border-color: #333333;
    }

    .quote-container {
      margin-bottom: 20px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    .height {
      max-height: 30vh;
      scrollbar-width: none;
    }
  </style>
</head>

<body class="d-flex">

  <div class="navbar navbar-expand-lg bg-dark text-white fixed-top fs-4 background" style="width: calc(100vw - 16.5rem); margin-left: calc(16.5rem);">
    <div class="container-fluid ps-0">
      <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item d-flex justify-content-center mb-3 mb-md-0 me-md-auto text-white align-items-start text-decoration-none">
            <a href="https://pmg-projects.eu/"><img width="40" height="40" src="https://img.icons8.com/external-nawicon-detailed-outline-nawicon/64/FFFFFF/external-school-back-to-school-nawicon-detailed-outline-nawicon.png" alt="external-school-back-to-school-nawicon-detailed-outline-nawicon" /></a>
            <a class="nav-link text-white" aria-current="page" href="https://pmg-projects.eu/">ПМГ "Иван Вазов"</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- navbar for larger screens -->
  <div class="sticky-sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark d-none d-lg-block background" style="width: 16.5rem; z-index: 10000;">
    <!-- Sidebar content here -->
    <a href="{{route('index')}}" class="d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="display-5 fw-bold">STEM.lib</span><!--ЕдуРесурс: Виртуална Библиотека за Учители и Ученици //Самрт Библиотека//Libraryi//Libbl//Librida//ЛИБТЕХ//ТЕХЛИБ--->
    </a>
    <hr>

    <!-- Links -->
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('index')}}" class="nav-link {{ Request::routeIs('index') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/home--v1.png" alt="home--v1" />
          Начало
        </a>
      </li>
      <li>
        <a href="{{route('books')}}" class="nav-link {{ Request::routeIs('books') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/books.png" alt="books" />
          Книги
        </a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link {{ Request::routeIs('materials') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/reading.png" />
          Материали
        </a>
        @php
        use App\Models\Student;
        use App\Models\Exercise_Material;
        use App\Models\School_class;
        use App\Models\Admin;
        use App\Models\Teacher;
        use Illuminate\Support\Str;

        if(!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists())
        {
        $classId = Student::where('user_id', Auth::user()->id)->first()->class_id;
        $classStudent = School_class::where('id', $classId)->first()->class;

        $classTest = preg_replace('/[^0-9]/', '', $classStudent);
        $classStudentNumber = preg_replace('/[^0-9]/', '', $classTest);

        $currentClass = $classTest;

        while ($classStudentNumber >= $classTest) {
        $currentClass++;
        $classTest = preg_replace('/[^0-9]/', '', $currentClass);
        }

        $currentClass = $currentClass-1;
        $classIdStudent = School_class::where('class', $currentClass . 'в')->first()->id;
        $classesStudent = School_class::where('id', '<=', $classIdStudent)->get();
          }
          @endphp
          @if(!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists())
          <ul class="dropdown-menu dropdown-menu-dark w-100 height overflow-y-auto">
            @foreach($classesStudent as $class)
            <li><a class="dropdown-item " href="{{ route('materials', ['class' => $class->class]) }}">{{$class->class}}</a></li>
            @endforeach
          </ul>
          @else
          <ul class="dropdown-menu dropdown-menu-dark w-100 height overflow-y-auto">
            @foreach($classes as $class)
            <li><a class="dropdown-item" href="{{ route('materials', ['class' => $class->class]) }}">{{$class->class}}</a></li>
            @endforeach
          </ul>
          @endif
      </li>
      <li>
        <a href="{{ route('recentryAdded') }}" class="nav-link {{ Request::routeIs('recentryAdded') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/time-machine--v1.png" alt="time-machine--v1" />
          Наскоро добавени
        </a>
      </li>
      <!-- <li>
        <a href="#" class="nav-link text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/innovation.png" />
          Въпроси и идеи
        </a>
      </li> -->
      @if(Admin::where('user_id', Auth::user()->id)->exists() || Teacher::where('user_id', Auth::user()->id)->exists())
      <li>
        <a href="{{ route('material.add') }}" class="nav-link {{ Request::routeIs('material.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/material-rounded/24/FFFFFF/add-folder.png" />
          Качване на материали
        </a>
      </li>
      <li>
        <a href="{{ route('book.add') }}" class="nav-link {{ Request::routeIs('book.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
          <img width="35" height="35" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/add-book.png" />
          Качване на книги
        </a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link {{ Request::routeIs('author.add') ? 'activePage' : '' }} {{ Request::routeIs('subject.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/plus--v1.png" alt="plus--v1" />
          Разширено добавяне
        </a>
        <ul class="dropdown-menu dropdown-menu-dark w-100">
          <li><a class="dropdown-item {{ Request::routeIs('author.add') ? 'activePage' : '' }}" href="{{ route('author.add') }}">Автор</a></li>
          <li><a class="dropdown-item {{ Request::routeIs('subject.add') ? 'activePage' : '' }}" href="{{ route('subject.add') }}">Учебен предмет</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link {{ Request::routeIs('user.add') ? 'activePage' : '' }} {{ Request::routeIs('view.user.import') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/add-administrator.png" />
          Добави потребител
        </a>
        <ul class="dropdown-menu dropdown-menu-dark w-100">
          <li><a class="dropdown-item {{ Request::routeIs('user.add') ? 'activePage' : '' }}" href="{{ route('user.add') }}">Ръчно</a></li>
          <li><a class="dropdown-item {{ Request::routeIs('view.user.import') ? 'activePage' : '' }} text-wrap" href="{{ route('view.user.import') }}">Чрез excel файл (само за ученици)</a></li>
        </ul>
      </li>
      @endif
    </ul>
    <hr>

    <!-- User -->
    <div class="dropdown fs-5 text-wrap d-flex align-items-end position-absolute bottom-0 start-0 ms-3 mb-3" style="width: 85%;">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle text-wrap" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>{{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="dropdown-item">Изход</button>
        </form>
      </ul>
    </div>

  </div>

  <!-- Navbar for smaller screen -->
  <div class="content-container">
    <!-- Navbar for smaller screens -->
    <nav class="navbar navbar-expand-lg bg-dark text-white fixed-top d-lg-none">
      <div class="container-fluid">
        <a class="navbar-brand text-white fs-3" href="{{route('index')}}">STEM.lib</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="border-color: white; color: white !important;">
          <img width="35" height="40" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/menu--v3.png" alt="menu--v3" />
        </button>

        <div class="navbar-collapse collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a href="{{route('index')}}" class="nav-link {{ Request::routeIs('index') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/home--v1.png" alt="home--v1" />
                Начало
              </a>
            </li>
            <li>
              <a href="{{route('books')}}" class="nav-link {{ Request::routeIs('books') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/books.png" alt="books" />
                Книги
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link {{ Request::routeIs('materials') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/reading.png" />
                Материали
              </a>
              @if(!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists())
              <ul class="dropdown-menu dropdown-menu-dark w-100 height overflow-y-auto">
                @foreach($classesStudent as $class)
                <li><a class="dropdown-item" href="{{ route('materials', ['class' => $class->class]) }}">{{$class->class}}</a></li>
                @endforeach
              </ul>
              @else
              <ul class="dropdown-menu dropdown-menu-dark w-100 height overflow-y-auto">
                @foreach($classes as $class)
                <li><a class="dropdown-item" href="{{ route('materials', ['class' => $class->class]) }}">{{$class->class}}</a></li>
                @endforeach
              </ul>
              @endif
            </li>
            <li>
              <a href="{{ route('recentryAdded') }}" class="nav-link {{ Request::routeIs('recentryAdded') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/time-machine--v1.png" alt="time-machine--v1" />
                Наскоро добавени
              </a>
            </li>
            @if(Admin::where('user_id', Auth::user()->id)->exists() || Teacher::where('user_id', Auth::user()->id)->exists())
            <li>
              <a href="{{ route('material.add') }}" class="nav-link {{ Request::routeIs('material.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
                <img width="35" height="35" src="https://img.icons8.com/material-rounded/24/FFFFFF/add-folder.png" />
                Качване на материали
              </a>
            </li>
            <li>
              <a href="{{ route('book.add') }}" class="nav-link {{ Request::routeIs('book.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0">
                <img width="35" height="35" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/add-book.png" />
                Качване на книги
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link {{ Request::routeIs('author.add') ? 'activePage' : '' }} {{ Request::routeIs('subject.add') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/plus--v1.png" alt="plus--v1" />
                Разширено добавяне
              </a>
              <ul class="dropdown-menu dropdown-menu-dark w-100">
                <li><a class="dropdown-item {{ Request::routeIs('author.add') ? 'activePage' : '' }}" href="{{ route('author.add') }}">Автор</a></li>
                <li><a class="dropdown-item {{ Request::routeIs('subject.add') ? 'activePage' : '' }}" href="{{ route('subject.add') }}">Учебен предмет</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link {{ Request::routeIs('user.add') ? 'activePage' : '' }} {{ Request::routeIs('view.user.import') ? 'activePage' : '' }} text-white fs-5 ps-1 pe-0 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="35" height="35" src="https://img.icons8.com/ios/50/FFFFFF/add-administrator.png" />
                Добави потребител
              </a>
              <ul class="dropdown-menu dropdown-menu-dark w-100">
                <li><a class="dropdown-item {{ Request::routeIs('user.add') ? 'activePage' : '' }}" href="{{ route('user.add') }}">Ръчно</a></li>
                <li><a class="dropdown-item {{ Request::routeIs('view.user.import') ? 'activePage' : '' }} text-wrap" href="{{ route('view.user.import') }}">Чрез excel файл (само за ученици)</a></li>
              </ul>
            </li>
            @endif
            <li>
              <div class="dropdown fs-5 text-wrap bottom-0 start-0 ms-2 mb-3" style="width: 85%;">
                <a href="#" class="text-white text-decoration-none dropdown-toggle text-wrap" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <strong>{{Auth::user()->first_name}} {{Auth::user()->middle_name}} {{Auth::user()->last_name}}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Изход</button>
                  </form>
                </ul>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </nav>

    <!-- Content for larger screens -->
    <div class="flex-grow-1 p-3" style="margin-top: 60px;">
      @yield('content')
    </div>

  </div>
</body>

</html>