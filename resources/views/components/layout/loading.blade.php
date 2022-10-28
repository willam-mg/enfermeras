{{-- style="display:none" --}}
{{-- <div wire:loading @if ($target) wire:target="{{$target}}" @endif style="display:none"> --}}
<div wire:loading style="display:none">
    <div class="loading">
        <div class="d-flex justify-content-center">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        Cargando ...
    </div>
</div>