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
            @include('rfc-card', ['issue' => $issue])
        @endforeach
    </main>
@endsection
