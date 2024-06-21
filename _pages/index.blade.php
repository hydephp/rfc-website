@extends('hyde::layouts.app')
@section('content')
@php($title = "RFCs")
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
                    <strong>Created:</strong> {{ $issue->created }}<br>
                    @if($issue->updated !== $issue->created)
                        <strong>Updated:</strong> {{ $issue->updated }}<br>
                    @endif
                    <strong>Status:</strong> {{ $issue->status }}<br>
                </p>
                <p>
                    {{ $issue->content }}
                </p>
            </article>
        @endforeach
    </main>
@endsection
