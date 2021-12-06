<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>

    <title>{{ env('APP_NAME', 'Laravel Calendar') }}</title>

    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="bg-base-200">
    <div id="app"></div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toast.js') }}" type="text/javascript"></script>
</body>
</html>