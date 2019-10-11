<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vuejs</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script>
          window.Laravel = { csrfToken: '{{ csrf_token() }}' }
        </script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        
        <div id="app">
          <article-component></article-component>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
