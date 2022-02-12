<div class="form-group">

    <label>Title</label>

    <input id="title" class="form-control" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">

</div>

{{-- every line error handling code --}}
{{-- @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

<div class="form-group">

    <label>Content</label>

    <input id="content" class="form-control" type="text" name="content" value="{{ old('content', optional( $post ?? null)->content) }}">

</div>

<div class="form-group">

    <label>Thumbnail</label>

    <input id="content" class="form-control-file" type="file" name="thumbnail">

</div>

<x-errors />
{{-- this uses for errors catche register by appserviceprovider --}}

{{-- Every errors handling --}}
{{-- @if ($errors->any())
    <div class="mb-3">
        <ul class="list-group">
            @foreach ( $errors->all() as $error )
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- @component('components.errors')@endcomponent --}}
{{-- {{-- this uses for errors catche that is worked directly for blade component}} --}}
