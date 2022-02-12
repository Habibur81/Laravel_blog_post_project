@extends('layout')

@section('content')

    @section('title', 'contact-page')
    <h1>Contact</h1>
    <p>Hello this is contact!</p>

    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">
                Special Contact details
            </a>
        </p>
    @endcan

@endsection
