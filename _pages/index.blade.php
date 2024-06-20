@extends('hyde::layouts.app')
@section('content')
@php($title = "RFCs")

<style>
    header {
        margin-bottom: 20px;
    }

    header h1 {
        font-size: 2.5em;
        margin: 0;
    }

    header p[role="doc-subtitle"] {
        font-size: 1.5em;
        margin: 0;
    }
</style>

    <header class="text-center">
        <h1>HydePHP RFCs</h1>
        <p role="doc-subtitle">Request for Comments</p>
        <p>
            This website lists all the RFCs for the HydePHP framework.
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
