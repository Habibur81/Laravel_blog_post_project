<div class="container">

    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title text-center">Most Commented</h5>
                <h6 class="card-text text-center card-subtitle text-muted mb-2">What people are currently
                    talking about</h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($MostCommented as $post)
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                        <li class="list-group-item text-center">{{ $post->title }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>

    <br>

    {{-- <div class="row">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                    <h5 class="card-title text-center">Most Active</h5>
                    <h6 class="card-text text-center card-subtitle text-muted mb-2">Whome people most active blog post</h6>
                    </div>
                    <table class="table">
                        <thead>
                            <tr scope="row">
                                <th class="text-center">Id</td>
                                <th class="text-center">Name</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mostActiveUser as $user)
                                <tr scope="row">
                                    <td class="text-center">{{$user->id}}</td>
                                    <td class="text-center">  {{$user->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
    {{-- component and uporer coder kaj same --}}

    <div class="row">
        @component('components.card', ['title' => 'Most Active'])

            @slot('subtitle')
                Whome people most active blog post
            @endslot

            @slot('items', collect($mostActiveUser)->pluck('name'))

        @endcomponent
            {{-- component used there --}}
    </div>


    <br>

        {{-- <div class="row">
            <div class="card" style="width: 100%">
                <div class="card-body">
                  <h5 class="card-title text-center">Most Active Last Month</h5>
                  <h6 class="card-text text-center card-subtitle text-muted mb-2">Whome people most active Last Month</h6>
                </div>
                <table class="table">
                    <thead>
                        <tr scope="row">
                            <th class="text-center">Id</td>
                            <th class="text-center">Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostActiveLastMonth as $user)
                            <tr scope="row">
                                <td class="text-center">{{$user->id}}</td>
                                <td class="text-center">  {{$user->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
        {{-- component and uporer coder kaj same --}}
    <div class="row">
        @component('components.card', ['title' => 'Most Active Last Month'])

            @slot('subtitle')
                Whome people most active Last Month
            @endslot

            @slot('items', collect($mostActiveLastMonth)->pluck('name'))

        @endcomponent
        {{-- component used there --}}
    </div>

</div>
