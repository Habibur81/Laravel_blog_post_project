<p class="text-muted">

    {{ empty( trim($slot) ) ? 'Added': $slot }} {{ $date->diffForHumans() }}

    <br>

    @if( isset($name) )

        @if ( isset($userId) )

            Added by <a href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>

        @else

            Added By : {{ $name }}

        @endif

    @endif

</p>
