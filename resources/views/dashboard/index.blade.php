<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Technical Interview Project</title>

    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />


    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>