<form action="{{ url('afiliados/requisitos', $model->id) }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <h4>Requisitos</h4>
        </div>
        <div class="col-xs-12 col-md-9 mb-3 text-end">
            <button class="btn btn-link" id="btnSelectAll" type="button">
                <i class="bi bi-check-all"></i>
                Seleccionar todo
            </button>
            <button class="btn btn-primary" type="submit" id="btnGuardar">
                <i class="bi bi-save"></i>
                Guardar
            </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-md-12">
            <div class="progress">
                <div class="progress-bar {{$porcentajeColor}}" role="progressbar" style="width: {{ $porcentaje }}%" aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100">
                    <strong>
                        {{ $porcentaje }} %
                    </strong>
                </div>
            </div>
        </div>
    </div>
    <ul class="list-group mb-3">
        @foreach ($requisitos as $item)
            <li class="list-group-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="requisitos[]" value="{{$item->id}}" id="flexCheck-{{$item->id}}" {{in_array($item->id, $misRequisitos)?'checked':''}}>
                    <label class="form-check-label" for="flexCheck-{{$item->id}}">
                        {{$item->numero}} .- 
                        {{$item->requisito}} 
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        $("#btnSelectAll").on("click", function() {
            $('.form-check-input').prop('checked', true);
        });
    });
</script>