<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="..."
        crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>LifeFlow-Hub</title>
</head>

<body class="login-body">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row">
            <div class="col">
                <div class="card border-0 shadow rounded-3 my-5 login-card">
                    <div class="card-body p-4 p-sm-5">
                        <h2 class="card-title text-center mb-5 fw-light text-uppercase fw-bold">LifeFlow-Hub</h2>
                        @if (session('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat!',
                                    text:'Pengguna tidak wujud!',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            </script>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold"
                                    type="submit">Login</button>
                            </div>

                            <hr class="my-4">

                            <div class="form-floating mb-3">
                                <p>No Account? <a href="#">Sign Up</a></p>
                            </div>

                            <div class="form-floating">
                                <p>Forgot Password? <a href="#">Reset Password</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
