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

@endsection
