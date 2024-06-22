<!DOCTYPE html>
<html lang="{{ config('hyde.language', 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title() }}</title>
    @include('hyde::layouts.meta')
    @scss('app')
    <noscript>
        <style>
            .requires-js {
                display: none;
            }
        </style>
    </noscript>
</head>
<body class="{{ strtolower(\Illuminate\Support\Str::before(class_basename($page::class), 'Page')) }}-page {{ $page::$outputDirectory ?: $page->identifier }}-page">

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
    <p class="print-only">
        <small>
            Page generated at {{ date('Y-m-d H:i:s T') }}<br>
            {{ $page->getCanonicalUrl() }}
        </small>
    </p>
</footer>
    <script type="text/javascript">
        window.onbeforeprint = function() {
            addPageNumbers();
        };

        function addPageNumbers() {
            console.log("Adding page numbers")
            var totalPages = Math.ceil(document.body.scrollHeight / 1123);  //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi,
            for (var i = 1; i <= totalPages; i++) {
            var pageNumberDiv = document.createElement("div");
            var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
            pageNumberDiv.style.position = "absolute";
            pageNumberDiv.style.marginTop = "calc((" + i + " * (297mm - 0.5px)) - 40px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
            pageNumberDiv.style.height = "16px";
            pageNumberDiv.appendChild(pageNumber);
            document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
            pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
        }
    }
</script>
</body>
</html>
