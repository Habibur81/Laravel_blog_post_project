@extends('layout')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}"
                class="img-thumbnail avatar" />

        </div>
        <div class="col-8">
            <h3><span class="badge badge-success">Post Created By</span>  {{ $user->name }}</h3>
            <br>
            <p>Currently viewed by {{$counter}} other users</p>
            <br>
            <h5>Comments</h5>
            @component('components.comment-form', ['route' => route('users.comments.store', ['user' => $user->id])] )
            @endcomponent
            {{-- post comment form --}}
            <br>
            <h4>Comments list</h4>
            @component('components.comment-list', ['comments' => $user->commentsOn])
            @endcomponent
            {{-- post comment list --}}

        </div>
    </div>
@endsection
