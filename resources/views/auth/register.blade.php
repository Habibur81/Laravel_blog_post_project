@extends('layout')

@section('content')

    <form action="{{ route('register') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="form-control"{{ $errors->has('name') ? 'is_invalid': '' }} >
            @if ( $errors->has('name')  )
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required
            class="form-control"{{ $errors->has('email') ? 'is_invalid': '' }} >
            @if ( $errors->has('email')  )
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Password</label>
            <input  type="password" name="password" value="{{ old('name') }}" required
            class="form-control"{{ $errors->has('password') ? 'is_invalid': '' }} >
            @if ( $errors->has('password')  )
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Confirm</label>
            <input class="form-control" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register!</button>

    </form>

@endsection
