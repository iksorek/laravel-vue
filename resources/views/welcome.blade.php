<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MY BNB Project</title>
    <script src="https://kit.fontawesome.com/9c9b10d197.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
<div id="app">
    <index></index>
</div>
</body>
</html>
