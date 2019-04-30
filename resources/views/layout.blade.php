<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139229855-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-139229855-1');
        </script>
        <!-- CSS And JavaScript -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
        <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @yield('css')
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- レスポンシブ -->
    </head>
    <body>
        <div class="container">
        <nav>@yield('breadcrumbs')</nav>
            @yield('content')
        </div>
    </body>
</html>