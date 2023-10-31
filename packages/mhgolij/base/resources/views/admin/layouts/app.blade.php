<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('mhgolijBase::admin.layouts.styles')
    @yield('styles')
    @vite(['vendor/mhgolij/base/resources/css/mhgolijBaseApp.css','vendor/mhgolij/base/resources/js/mhgolijBaseApp.js','resources/css/app.css'])
    <title>{{@$title}}</title>
</head>
<body>
<div class="h-screen w-full bg-white relative flex overflow-hidden">
    @include('mhgolijBase::admin.layouts.right-side')
    <div class="w-full h-full flex flex-col dark:bg-gray-700 ">
        <!-- Header -->
        @include('mhgolijBase::admin.layouts.navbar')

        @yield('content')
    </div>
    @include('mhgolijBase::admin.layouts.left-sidebar')
</div>
@include('mhgolijBase::admin.layouts.toast')
@include('mhgolijBase::admin.layouts.scripts')
@yield('scripts')
</body>
</html>
