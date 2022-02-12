<div class="mb-2 mt-3">

    @auth

        <form action="{{ $route }}" method="POST">

            @csrf

            <div class="form-group">
                <textarea class="form-control" type="text" name="content"></textarea>
            </div>

            <button class="btn btn-primary btn-block" type="submit"> Add Comment! </button>

        </form>

    @else

        <a href="{{ route('login') }}">Sign In</a> to post comments!

    @endauth

</div>

<x-errors />

<hr/>
