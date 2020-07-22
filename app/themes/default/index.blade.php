<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/app/themes/default/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link href="/app/themes/default/css/app.css" rel="stylesheet">

    <!-- Scripts -->
	<? /*<script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">*/ ?>
</head>
<body>
<div id="app">
    <!--<App></App>-->
    <router-view></router-view>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


<script src="/app/themes/default/dist/App.umd.min.js"></script>


<script src="/app/js/node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="/app/js/node_modules/@ckeditor/ckeditor5-vue/dist/ckeditor.js"></script>

<script src="/app/js/library/dist/library.umd.min.js"></script>

<script src="/app/js/dist/main.js"></script>
</body>
</html>

