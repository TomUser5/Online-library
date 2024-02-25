<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM.lib</title>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/external-vitaliy-gorbachev-lineal-color-vitaly-gorbachev/60/external-online-library-online-learning-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="...">

    <style>
        .gradient-custom {
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(52, 152, 219, 1), rgba(46, 204, 113, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(52, 152, 219, 1), rgba(46, 204, 113, 1));
        }

        .form-floating input:focus+label {
            background-color: transparent;
        }
    </style>
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mt-4">

                                <h2 class="fw-bold mb-5">Влизане в профил</h2>

                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                                @endif

                                <form class="form-floating bg-dark" method="POST" action="login/store">
                                    @csrf

                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label>Email</label>
                                    </div>
                                    @error('email')
                                    <strong>
                                        <p style="color: red;">{{ $message }}</p>
                                    </strong>
                                    @enderror
                                    <br>
                                    @error('bothError')
                                    <strong>
                                        <p style="color: red;">{{ $message }}</p>
                                    </strong>
                                    @enderror

                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Парола</label>
                                    </div>

                                    <div class="form-check d-flex align-items-center mt-2 ml-0">
                                        <input type="checkbox" class="form-check-input" id="showPassword" onclick="myFunction()">
                                        <label class="form-check-label ps-2 pt-1" for="showPassword">Покажи паролата</label>
                                    </div>
                                    @error('password')
                                    <strong>
                                        <p style="color: red;">{{ $message }}</p>
                                    </strong>
                                    @enderror
                                    <br>

                                    <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                                    <button class="btn btn-outline-light btn-lg px-5 mt-5" type="submit">Вход</button>
                                    <div class="form-floating pt-4">
                                        <p>Ако профилът Ви е създаден през последните 24 часа и не сте си отваряли email-а за да зададете парола на профила - проверете си email-а, а в случай на забравена парола от <a href="{{ route('forget.password.get') }}">тук</a> можете да я смените.</p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function myFunction() {
            var x = document.getElementById("floatingPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>