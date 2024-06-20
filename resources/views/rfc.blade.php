@extends('hyde::layouts.app')
@section('content')

    <style>
        nav {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            background-color: #f8f9fa;
        }

        nav strong a {
            color: #333;
            text-decoration: none;
        }

        @media screen {
            article > pre {
                background-color: #f8f9fa;
                padding: 10px;
                border-radius: 5px;
                overflow-x: auto;
            }
        }

        @media print {
            article > pre {
                margin-left: 20px;
            }
        }
    </style>

    <nav class="no-print">
        <strong>
            <a href="{{ route('index') }}">HydePHP RFCs</a>
        </strong>

        <span>
            [<a href="{{ route('index') }}">RFC Home</a>]
            <span class="requires-js">
                [<a onclick="window.print(); return false;" href="">Print</a>]
            </span>
        </span>
    </nav>

    <main>
        <article>
            <header>
                <h1>{{ $title }}</h1>
                <p class="meta">
                    Author: {{ $page->author }} <br>
                    <time datetime="{{ $page->created }}">Created: {{ $page->created }}</time>
                    @if ($page->updated !== $page->created)
                        &middot; <time datetime="{{ $page->updated }}">Updated: {{ $page->updated }}</time>
                    @endif
                </p>
            </header>
            {{ $content }}
        </article>
    </main>

@endsection