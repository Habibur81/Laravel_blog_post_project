@extends('layout')

@section('content')
    @section('title', 'Create blog post')

    <form action="{{ route('posts.store')  }}" method="POST" enctype="multipart/form-data">

        @csrf

        @include('posts.form')

        <button class="btn btn-primary btn-block" type="submit"> Add Post! </button>

    </form>

@endsection
