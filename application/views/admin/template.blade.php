<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>  {{Setting::find(9)->value}}  :
        @yield('title')</title>
    @yield('headerfiles')
</head>
<body>
<div style="float:left;background: #f5f5f1;padding: 5px 10px;;;margin-right: 5px;"><a href="/admin">DashBoard</a></div><div id="topbar">Welcome, {{ Auth::user()->displayname }} -  <a href="/logout">Logout</a> | <a target="_blank" href="../../"> Visit Site</a></div>


@yield('content')

</body>
</html>