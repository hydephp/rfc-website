@extends('hyde::layouts.app')
@section('content')

    <main>
        <article>
            <header>
                <h1>{{ $title }}</h1>
                <p class="meta">
                    Author: {{ $page->author }} <br>
                    <time datetime="{{ $page->created }}">Created {{ $page->created }}</time>
                    @if ($page->updated !== $page->created)
                        &middot; <time datetime="{{ $page->updated }}">Updated {{ $page->updated }}</time>
                    @endif
                </p>
            </header>
            {{ $content }}
        </article>
    </main>

@endsection