<!DOCTYPE html>
<html>

<head>
    <title>@yield('title','weibo APP')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/sass/app.scss'])
</head>

<body>
    @include('layouts._header')

    <div class="container">
        <div class="offset-md-1 col-md-10">
            @include('shared._messages')
            @yield('content')
            @include('layouts._footer')
        </div>
    </div>
</body>

</html>
