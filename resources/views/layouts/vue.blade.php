<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nicepay Payments Demo</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/font-awesome/css/font-awesome.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <main id="app">            
        <navigation></navigation>
        <main id="main" role="main">
            <section id="checkout-container" class="han-container">
                <router-view></router-view>
            </section>
        </main>
        {{-- <copyright></copyright> --}}
    </main>
    
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="{{ asset('assets/dist/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/popper/popper.min.js') }} " integrity=""></script>
    <script src="{{ asset('assets/dist/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/main.min.js')}}"></script>
</body>
</html>