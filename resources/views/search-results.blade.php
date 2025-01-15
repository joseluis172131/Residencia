@extends('layouts.app')

@section('content')
    <h1>Search Results</h1>

    @if ($results->isEmpty())
        <p>No results found for "{{ $searchTerm }}".</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
