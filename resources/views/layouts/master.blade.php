<!DOCTYPE html>
<html lang="en-us"><head>
    <meta charset="utf-8">
    <title>Reader | Hugo Personal Blog Template</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3" />
    <!-- theme meta -->
    <meta name="theme-name" content="reader" />
    <!-- plugins -->
    <meta property="og:title" content="Reader | Hugo Personal Blog Template" />
    <meta property="og:description" content="This is meta description" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:updated_time" content="2020-03-15T15:40:24+06:00" />
    @include('layouts.partials.css')
</head>
<body>
<!-- navigation -->
<header class="navigation fixed-top">
    @include('layouts.partials.head')
</header>
<!-- /navigation -->

@yield('content')

<footer class="footer">
    @include('layouts.partials.footer')
</footer>


<!-- JS Plugins -->
@include('layouts.partials.js')

</body>
</html>
