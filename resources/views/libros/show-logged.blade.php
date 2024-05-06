@extends('layouts.general-logged')

@section('title', $book['title'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $book['cover_url'] }}" class="img-fluid" alt="Cover of {{ $book['title'] }}">
        </div>
        <div class="col-md-8">
            <h1>{{ $book['title'] }}</h1>
            <p><strong>Author(s):</strong> {{ implode(', ', $book['authors']) }}</p>
            <p><strong>Description:</strong> {{ $book['description'] }}</p>
        </div>
    </div>
</div>
@endsection
