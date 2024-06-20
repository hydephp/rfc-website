@extends('hyde::layouts.app')
@section('content')
@php($title = "RFCs")

<style>
    header {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    header h1 {
        font-size: 2.5em;
        margin: 0;
    }

    header p {
        font-size: 1.2em;
        margin: 0;
    }
</style>

    <header class="text-center">
        <h1>HydePHP RFCs</h1>
        <p role="doc-subtitle">
            This website lists all the Request for Comments for the HydePHP framework.
        </p>
    </header>

    <main>
        @foreach(app(\App\RFCService::class)->getItems()->issues() as $issue)
            <article>
                <h2>{{ $issue->title }}</h2>
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
