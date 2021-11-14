<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Technical Interview Project</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />


    <script>
        window.baseUrl = "{{ url('/') }}";
        </script>
        
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>