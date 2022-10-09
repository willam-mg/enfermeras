<form action="{{ route('afiliados.index') }}" method="get" class="needs-validation disabled-onsubmit" novalidate>
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <div class="form-floating mb-3">
                <input type="text" name="numero_afiliado" value="{{$modelFilter->numero_afiliado}}" class="form-control @error('numero_afiliado') is-invalid @enderror" placeholder="Nombre">
                <label class="form-label" for="numero_afiliado">Numero de afiliado</label>
                @error('numero_afiliado')
                <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="form-floating mb-3">
                <input type="text" name="nombre_completo" wire:model="model.nombre_completo" value="{{$modelFilter->nombre_completo}}" class="form-control @error('nombre_completo') is-invalid @enderror" placeholder="Nombre">
                <label class="form-label" for="nombre_completo">Nombre completo</label>
                @error('nombre_completo')
                <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="form-floating mb-3">
                <input type="text" name="ci" value="{{$modelFilter->ci}}" class="form-control @error('ci') is-invalid @enderror" placeholder="ci">
                <label class="form-label" for="ci">Ci</label>
                @error('ci')
                <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <button type="submit" class="btn btn-primary mt-2">
                <i class="bi bi-search"></i>
                {{ __('Buscar') }}
            </button>
        </div>
    </div>
</form>