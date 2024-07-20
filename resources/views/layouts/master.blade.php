<!DOCTYPE html>
<html lang="en-us"><head>
    <meta charset="utf-8">
    <title>@yield('title') | Reader</title>

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
    <style>
        .btn-custom-sm {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            line-height: 1.2;
            height: 37px;
            border-radius: 0.2rem;
            width: 104px;
        }

        .btn-custom-sm i {
            font-size: 0.8rem;
        }
        /* width */
        ::-webkit-scrollbar {
            width: 2px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 2px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #9ca3af;
            border-radius: 2px;
        }
    </style>
</head>
<body ng-app="myApp" ng-controller="myCtrl">
<!-- navigation -->
<header class="navigation fixed-top">
    @include('layouts.partials.head')
</header>
<!-- /navigation -->

<div ng-controller="viewCtrl">
    @yield('content')
</div>

<footer class="footer">
    @include('layouts.partials.footer')
</footer>

@include('layouts.partials.modal')

<!-- JS Plugins -->
@include('layouts.partials.js')
<script>
    let myApp = angular.module('myApp', []);
    myApp.controller('myCtrl', function($scope) {
    });
    function viewFunction($scope, $http) {
    }
</script>
@yield('js')
<script>
    myApp.controller('viewCtrl', viewFunction);
</script>
</body>
</html>
