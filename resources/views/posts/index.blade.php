@extends('layout')

@section('content')

    <div class="row">

        <div class=" col-8">

            @section('title', ' Blog post index')

            @forelse ( $post as $post )

                <h3>

                    @if ($post->trashed())
                        <del>
                    @endif
                    {{-- used to delete html tag --}}

                    <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                        class="{{ $post->trashed() ? 'text-muted' : '' }}">

                        {{ $post->title }}

                    </a>
                    {{-- this link used for show title and --}}

                    @if ($post->trashed())
                        </del>
                    @endif
                    {{-- used to delete hthl tag --}}

                </h3>

                {{-- <p class="text-muted">
                        Added Post: {{ $post->created_at->diffForHumans() }}
                        <br>
                        Added By: {{ $post->user->name }}
                    </p> --}}
                {{-- component and this code work same --}}
                @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])

                @endcomponent
                {{-- this component used for showing post created time and post created name show --}}

                @component('components.tags', ['tags' => $post->tags ])

                @endcomponent

{{--                @if ($post->comments_count)--}}
{{--                    <p class="text-success">--}}
{{--                        {{ $post->comments_count }} Comments--}}
{{--                    </p>--}}
{{--                @else--}}
{{--                    <p class="text-warning">No comments yet!</p>--}}
{{--                @endif--}}
{{--                 this condition used to comment count --}}

                {{ trans_choice('messages.comments', $post->comments_count) }}
                {{-- this condition used to comment count --}}
                <div>

                    @auth
                        @can('update', $post)
                            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                Edit
                            </a>
                        @endcan
                    @endauth
                    {{-- used to edit post --}}

                    {{-- @cannot('delete', $post)
                            <p>You can't delete!</p>
                        @endcannot --}}

                    @auth
                        @if (!$post->trashed())
                            @can('delete', $post)
                                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-primary" type="submit" value="Delete">
                                </form>
                            @endcan
                        @endif
                    @endauth
                    {{-- used for delete post --}}

                </div> {{-- soft delete and edit --}}
                <br>

            @empty
                No blog posts yet!
            @endforelse

        </div>

        <div class="col-4">
            @include('posts._activity')
        </div>

    </div>

@endsection
