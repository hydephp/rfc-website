{{-- The Markdown Page Layout --}}
@extends('hyde::layouts.app')
@section('content')
    <nav class="no-print">
        <strong>
            <a href="{{ route('index') }}">HydePHP RFCs</a>
        </strong>

        <span>
            [<a href="{{ route('index') }}">RFC Home</a>]
        </span>
    </nav>

    <main>
        <article>
            {{ $content }}
        </article>
    </main>

@endsection