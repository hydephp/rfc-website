<!DOCTYPE html>
<html lang="{{ config('hyde.language', 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title() }}</title>
    @include('hyde::layouts.meta')
    @include('styles')
</head>
<body>

@yield('content')

<footer class="text-center">
    <p>
        Copyright &copy; 2024 HydePHP. All rights reserved.
    </p>
    <p class="no-print">
        Site proudly built with <a href="https://hydephp.com?ref=rfc">HydePHP</a>.
    </p>
    <p class="no-print">
        <small>
            <a href="{{ route('process') }}">RFC Process</a> &middot;
            <a href="https://github.com/hydephp/rfc-website">Source Code</a> &middot;
            <a href="https://github.com/hydephp/rfc-website/issues/new" rel="nofollow">Report Issue</a>
        </small>
    </p>
</footer>
</body>
</html>
