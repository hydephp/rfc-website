@extends('hyde::layouts.app')
@section('content')
    <nav class="no-print">
        <strong>
            <a href="{{ route('index') }}">HydePHP RFCs</a>
        </strong>

        <span>
            [<a href="{{ route('index') }}">RFC Home</a>]
            [<a href="{{ $page->issue->github() }}">View on GitHub</a>]
            <span class="requires-js">
                [<a onclick="window.print(); return false;" href="">Print</a>]
            </span>
        </span>
    </nav>

    <main>
        <article>
            <header>
                <h1>{{ $title }}</h1>
                <fieldset>
                    <legend>Details</legend>
                    <p class="meta">
                        <b>Author:</b> {{ $page->author->name }}
                        (<a href="https://github.com/{{ $page->author->username }}" rel="author nofollow noopener" target="_blank">&commat;{{ $page->author->username }}</a>)
                        @if($page->author->isVerified())
                            <span title="This user is verified to be part of the HydePHP organization." class="no-print">✅</span>
                        @endif
                        <br>
                        <time datetime="{{ $page->created }}" title="{{ $page->created }}"><b>Created:</b> {{ $page->created->toHtml() }}</time>
                        @if ($page->updated !== $page->created)
                            &middot; <time datetime="{{ $page->updated }}" title="{{ $page->updated }}"><b>Updated:</b> {{ $page->updated->toHtml() }}</time>
                        @endif
                    </p>
                </fieldset>
            </header>
            <fieldset>
                <legend>Abstract</legend>
                {{ $content }}
            </fieldset>
        </article>
    </main>
@endsection