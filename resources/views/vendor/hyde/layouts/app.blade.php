<!DOCTYPE html>
<html lang="{{ config('hyde.language', 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title() }}</title>
    @include('hyde::layouts.meta')
</head>
<body>
    <section>
        @yield('content')
    </section>
</body>
</html>
