<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Klinik Pangeran</title>
    <link rel="icon" href="{{ asset('assets/images/logo-klinik.svg') }}" type="image/svg+xml" />
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-klinik.png') }}" alt="">
        </div>
        <div class="form">
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                @if(session('error'))
                    <div style="color:red; text-align:center; margin-bottom: 10px;">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="credentials">
                    <div class="email">
                        <span><i class="fas fa-user"></i></span>
                        <input type="email" name="email" placeholder="Email" required>
                        @error('email')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="password">
                        <span><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password" required>
                        @error('password')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button class="submit" type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
