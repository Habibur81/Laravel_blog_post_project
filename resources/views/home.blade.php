@extends('layout')

@section('content')


    <h1>{{__('messages.welcome')}}</h1>
    <h1>@lang('messages.welcome')</h1>

    <p>{{ __('messages.example_with_value', ['name' => ' Habib']) }}</p>

    <p>{{ trans_choice('messages.plural', 0, ['a' => 1]) }}</p>
    <p>{{ trans_choice('messages.plural', 1, ['a' => 1]) }}</p>
    <p>{{ trans_choice('messages.plural', 2, ['a' => 1]) }}</p>
    <p>Using Json:{{__('welcome to laravel')}}</p>
    <p>Using Json:{{__('Hello : name', ['name' => 'Habib'])}}</p>

    <p>This is the content of the main page</p>


@endsection
