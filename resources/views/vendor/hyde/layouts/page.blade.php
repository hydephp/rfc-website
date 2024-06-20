{{-- The Markdown Page Layout --}}
@extends('hyde::layouts.app')
@section('content')

    <main>
        <article>
            {{ $content }}
        </article>
    </main>

@endsection