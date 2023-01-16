<div class="border border-secondary mb-3 p-3 ">
    <div class="mb-2">
        Aportes seleccionados: 
        <b>
            {{$countAportesToPay}}
        </b>
    </div>
    <h3>
        Total:
        <span id="misaportes-total-aportes">{{$totalAportes}}</span> Bs.
    </h3>
</div>
<div class="d-grid gap-2">
    <button class="btn btn-outline-secondary mb-2" @if($countAportesToPay == 0) disabled @endif type="button" wire:click="initPorperties()">
        <i class="bi bi-trash"></i>
        limpiar todo
    </button>
    <button class="btn btn-success" @if($countAportesToPay == 0) disabled @endif wire:loading.attr="disabled" type="button" onclick="aportesStore()">
        <i class="bi bi-cash"></i>
        Registrar pago
    </button>
</div>