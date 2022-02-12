<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title> Laravel App  @yield('title')</title>
    </head>
    <body>

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-small mb-2">
            <h5 class="my-0 mr-md-auto font-weight-normal align-items-center"> Laravel Blog </h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark text-decoration-none" href="{{ route('home') }}">{{__('Home')}}</a>
                <a class="p-2 text-dark text-decoration-none" href="{{ route('contact') }}">{{__('Contact')}}</a>
                <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.index') }}">{{__('Blog Posts')}}</a>
                <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.create') }}">{{__('Add')}}</a>

                @guest
                    @if ( Route::has('register') )
                        <a class="p-2 text-dark text-decoration-none" href="{{ route('register') }}">{{__('Register')}}</a>
                    @endif
                    <a class="p-2 text-dark text-decoration-none" href="{{ route('login') }}">{{__('Login')}}</a>
                @else
                    <a class="p-2 text-dark text-decoration-none" href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                        {{__('Profile')}}
                    </a>
                    <a class="p-2 text-dark text-decoration-none" href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">
                        {{__('Edit Profile')}}
                    </a>
                    <a class="p-2 text-dark text-decoration-none" href="{{ route('logout') }}"
                       onclick=" event.preventDefault();document.getElementById('logout-form').submit(); ">{{__('Logout')}} ({{Auth::user()->name}})</a>
                    <form id="logout-form" action="{{ route('logout') }}" style="display: none;" method="POST">
                        @csrf
                    </form>
                @endguest

            </nav>
        </div>

        <div class="container">

            @if (session()->has('status'))
                <p style="color: green">
                    {{ session()->get('status') }}
                </p>
            @endif

            @yield('content')

        </div>

        <script src="{{ mix('js/app.js')}}" defer></script>

    </body>
</html>
