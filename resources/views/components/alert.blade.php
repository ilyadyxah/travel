<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    {{ $message}} @if(isset($item)){{ $item ? ' - ' . Str::upper($item) : null }}@endif
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
