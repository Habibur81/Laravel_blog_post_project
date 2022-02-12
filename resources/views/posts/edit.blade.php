@extends('layout')

@section('content')
    @section('title', 'Edit blog post')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        @include('posts.form')

        <input class="btn btn-primary btn-block" type="submit" value="Update">
    </form>
@endsection
