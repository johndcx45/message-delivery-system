<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Time Machine App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
            }
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #eee;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div id="app">
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
