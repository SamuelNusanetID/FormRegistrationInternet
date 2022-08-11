<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ URL::to('bin/img/favicon.ico') }}" type="image/x-icon">

    <!-- Recaptcha V2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::to('lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::to('bin/css/style.css') }}">
    @yield('CSS')

    <title>{{ $titlePage }} - FRION (Form Registrasi Internet Online Nusanet)</title>
</head>

<body>
    <a class="btn btn-success bg-gradient fixed-bottom btn-overlay text-white fw-bold"
        href="https://s.id/feedbackformregonline" target="_blank">
        <i class="fa-solid fa-comments me-1 fa-2x mb-2"></i>
        </br>
        Send Feedback
    </a>
    <div class="card begin-content">
        <div class="card-header p-0 m-0">
            @include('user.partials.navbar')
        </div>
        <div class="card-body bg-light bg-gradient">
            @yield('content-wrapper')
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ URL::to('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('JS')
</body>

</html>
