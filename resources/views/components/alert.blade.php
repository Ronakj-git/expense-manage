<div>
    @if (session($message))
        <div class="alert alert-{{$type}}">
            {{ session($message) }}
        </div>
    @endif
</div>
