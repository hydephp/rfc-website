@extends('hyde::layouts.app')
@section('content')
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
                    <b>Author:</b> {{ $page->author->name }}
                    (<a href="https://github.com/{{ $page->author->username }}" rel="author nofollow noopener" target="_blank">&commat;{{ $page->author->username }}</a>)
                    @if($page->author->isVerified())
                        <span title="This user is verified to be part of the HydePHP organization." class="no-print">✅</span>
                    @endif
                    <br>
                    <time datetime="{{ $page->created }}"><b>Created:</b> {{ $page->formatDate($page->created) }}</time>
                    @if ($page->updated !== $page->created)
                        &middot; <time datetime="{{ $page->updated }}"><b>Updated:</b> {{ $page->formatDate($page->updated) }}</time>
                    @endif
                </p>
            </header>
            {{ $content }}
        </article>
    </main>
@endsection