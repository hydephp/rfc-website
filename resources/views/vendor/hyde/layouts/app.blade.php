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
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            margin: 0 auto;
            width: 800px;
            max-width: 90vw;
            padding: 20px;
            flex: 1;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            white-space: pre;
            font-family: monospace;
            text-wrap: wrap;
        }

        footer {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
        }

        footer p {
            line-height: 1.5;
            margin: auto 0 0;
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

            footer {
                background-color: inherit;
            }
        }
    </style>
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
