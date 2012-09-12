<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>  {{Setting::find(9)->value}}  :
        @yield('title')</title>
    @yield('headerfiles')
</head>
<body>

@yield('content')

</body>
</html>