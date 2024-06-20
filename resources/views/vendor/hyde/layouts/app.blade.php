<!DOCTYPE html>
<html lang="{{ config('hyde.language', 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title() }}</title>
    @include('hyde::layouts.meta')
    <style>
        body {
            font-family: monospace;
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        main {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            white-space: pre;
            font-family: monospace;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            body {
                font-size: 10.5pt;
            }

            a:link, a:visited {
                color: inherit;
                text-decoration: none;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>
