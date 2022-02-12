<div class="card" style="width: 100%">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $title }}</h5>
        <h6 class="card-text text-center card-subtitle text-muted mb-2">{{ $subtitle }}</h6>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($items as $item)
            <li class="list-group-item">
                {{ $item }}
            </li>
        @endforeach
    </ul>
</div>
