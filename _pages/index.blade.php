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
                    <table>
                        <tbody>
                            <tr>
                                <th>Author:</th><td>{{ $issue->author->name }}</td>
                                <th>Status:</th><td>{{ $issue->status }}</td>
                                <th>Type:</th><td>{{ $issue->type }}</td>
                                <td><a href="{{ $issue->link }}">View on GitHub</a></td>
                            </tr>
                            <tr>
                                <th>Created:</th><td>{{ $issue->created }}</td>
                                @if($issue->updated !== $issue->created)
                                    <th>Updated:</th><td>{{ $issue->updated }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </header>
                <p>
                    {{ substr($issue->body, 0, 200) }}...
                </p>
            </article>
        @endforeach
    </main>
@endsection
