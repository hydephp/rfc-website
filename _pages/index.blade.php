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

    <header class="page-header text-center">
        <h1>HydePHP RFCs</h1>
        <p role="doc-subtitle">
            This website lists all the Request for Comments for the HydePHP framework.
        </p>
        <p>
            <small>
                Data is sourced from the <a href="https://github.com/hydephp/develop">Development Monorepository</a> and is built nightly using HydePHP.
            </small>
        </p>
    </header>

    <main>
        @foreach(app(\App\RFCService::class)->getItems()->issues() as $issue)
            <article>
                <header>
                    <a href="{{ $issue->link }}">
                        <h2>{{ $issue->prettyTitle }}</h2>
                    </a>
                    <p>
                        <strong>Author:</strong> {{ $issue->author->name }}
                        <strong>Status:</strong> {{ $issue->status }}
                        <strong>Type:</strong> {{ $issue->type }}
                    </p>
                    <p>
                        <strong>Created:</strong> {{ $issue->created }}
                        @if($issue->updated !== $issue->created)
                            <strong>Updated:</strong> {{ $issue->updated }}
                        @endif
                    </p>
                </header>
                <p>
                    {{ $issue->content }}
                </p>
            </article>
        @endforeach
    </main>
@endsection
