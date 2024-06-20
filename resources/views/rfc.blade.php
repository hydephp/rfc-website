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
                padding: 10px 15px;
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
                    Author: {{ $page->author->name }}
                    (<a href="https://github.com/{{ $page->author->username }}" rel="author nofollow noopener" target="_blank">&commat;{{ $page->author->username }}</a>)
                    @if($page->author->isVerified())
                        <span title="This user is verified to be part of the HydePHP organization.">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="12px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                    @endif
                    <br>
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