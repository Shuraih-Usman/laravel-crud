<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{(isset($title) ? $title.' | Books Library ' : 'Books Library') }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <div class="header">
        <div style="margin-bottom: 0px;padding-bottom: 0px;" class="header-title"> <a href="{{route('books.index')}}" style="color:#ffffff;text-decoration: none;">Books Library Web App - Laravel Crud </a> </div>
        <d> Develope | Code | Craft by : <a href="//fb.me/shuraih.usman>" style="color:#ffffff;text-decoration: none;">Shuraihu Usman </a> - +2348140419490 </d>
    </div>
@yield('content')

</body>
</html>
