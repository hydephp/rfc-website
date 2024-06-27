@extends('hyde::layouts.app')
@section('content')
@php($title = "RFCs")
    <nav class="no-print">
        <strong>
            <a href="{{ route('index') }}">HydePHP RFCs</a>
        </strong>

        <span>
            [<a href="{{ route('index') }}">RFC Home</a>]
            [<a href="https://hydephp.com?ref=rfc">HydePHP.com</a>]
        </span>
    </nav>

    <header class="text-center">
        <h1>HydePHP RFCs</h1>
        <p role="doc-subtitle">
            This website lists all the Request for Comments for the HydePHP framework.
        </p>
    </header>

    <main>
        @foreach(app(\App\RFCService::class)->getItems()->issues() as $issue)
            <article>
                <a href="{{ $issue->link }}">
                    <h2>{{ $issue->prettyTitle }}</h2>
                </a>
                <p>
                    <strong>Author:</strong> {{ $issue->author }}<br>
                    <strong>Status:</strong> {{ $issue->status }}<br>
                    <strong>Type:</strong> {{ $issue->type }}<br>
                </p>
                <p>
                    <strong>Created:</strong> {{ $issue->created }}
                    @if($issue->updated !== $issue->created)
                        <strong>Updated:</strong> {{ $issue->updated }}
                    @endif
                </p>
                <p>
                    {{ $issue->content }}
                </p>
            </article>
        @endforeach
    </main>
@endsection
