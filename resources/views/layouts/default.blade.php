<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" charset="utf-8">
    <title>@yield('title') - 校客商城</title>
    <link rel="stylesheet" type="text/css" href="/css/page.css">
    <link rel="stylesheet" type="text/css" href="/css/weui.css">
</head>
<body>

@include('layouts._warning')
<div class="container">
    <div class="page panel js_show">
        <div class="page__hd">
            @yield('page__hd')
        </div>
        <div class="page__bd">
            @yield('page__bd')
        </div>
        @include('layouts._footer')
    </div>
</div>
{{--<div class="container">--}}
{{--<div class="col-md-offset-1 col-md-10">--}}
{{--@include('shared._messages')--}}
{{--@yield('content')--}}
{{--@include('layouts._footer')--}}
{{--</div>--}}
{{--</div>--}}

</body>
</html>