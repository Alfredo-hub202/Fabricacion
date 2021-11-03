<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

        <!--JQUERY-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
      
        
        <!-- Los iconos tipo Solid de Fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
        <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

        <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
        <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
        
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    <div class="container">

        
        <hr>
        @if (session()->has('flash'))

        <div class="alert alert-info">{{session('flash')}}</div>

        @endif
    @yield('content')
    </div>

</body>
</html>
