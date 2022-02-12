
@forelse ( $comments as $comment )

@component('components.tags', ['tags' => $comment->tags ])

@endcomponent

<span class="text-info">Comments</span> {{ $comment->content  }}, <br>
{{-- <span class="text-muted">Added</span> {{ $comment->created_at->diffForHumans() }} <br><br> --}}

@component('components.updated', ['date' => $comment->created_at, 'name' =>$comment->user->name, 'userId' => $comment->user->id])
    Created:
@endcomponent

@empty
<P>No comment yet!</P>
@endforelse
