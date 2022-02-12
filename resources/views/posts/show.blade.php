@extends('layout')

@section('title', $post->title)

@section('content')

    <div class="row">

        <div class="col-8">

            @if ( $post->image  )
                <div style=" background-image: url('{{ $post->image->url() }}');
                        height: 340px; width:100%; color:white; text-align:center; background-attachment: fixed; )">

                    <h1 style="padding-top: 100px; text-shadow: 3px 5px #000;">

            @else
                <h1>
            @endif
                {{ $post->title }}

                @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) < 5])
                    Brand New post!
                @endcomponent

            @if ( $post->image )

                    </h1>
                </div>
            @else
                </h1>
            @endif

            <h3 style="padding-top: 20px;">{{ $post->title }}</h3>
            {{-- post title --}}


            <p>{{ $post->content }}</p>
            {{-- content of post --}}

            {{-- <img src="{{  $post->image->url()  }}" alt="Check your post image link please"> --}}


            {{-- <p>Added {{ $post->created_at->diffForHumans() }}</p> --}}
            @component('components.updated', ['date' => $post->created_at, 'name' =>$post->user->name])

            @endcomponent

            @component('components.updated', ['date' => $post->updated_at])
                Updated:
            @endcomponent

            @component('components.tags', ['tags' => $post->tags ])

            @endcomponent

{{--            <p> Currently read by {{ $counter }} people </p>--}}
            <p>{{ trans_choice('messages.people.reading', $counter ) }}</p>
{{--            count people --}}

            {{-- @if(( new Carbon\Carbon())->diffInMinutes($post->created_at) < 200)
                @component('components.badge', ['type' => 'primary'])
                    Brand New post!
                @endcomponent
            @endif --}}
            {{-- evabe used kora jai component but good practice hoto register kore newya --}}



            {{-- @if(( new Carbon\Carbon())->diffInMinutes($post->created_at) < 200)
                @badge('badge')
                    Brand New post!
                @endbadge
            @endif  --}}
            {{-- registration component properly kaj korche na  --}}

            <h4>Comments</h4>
            @component('components.comment-form', ['route' => route('posts.comments.store', ['post' => $post->id])] )
            @endcomponent
            {{-- post comment form --}}

            <br>

            <h4>Comments list</h4>
            @component('components.comment-list', ['comments' => $post->comments])
            @endcomponent
            {{-- post comment list --}}




        </div>

        <div class="col-4">
            @include('posts._activity')
        </div>

    </div>


@endsection
