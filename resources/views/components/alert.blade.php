<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    {{ $message}} {{ $item ? ' - ' . Str::upper($item) : null }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
