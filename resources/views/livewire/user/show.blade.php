<div>
    <x-page.loading />
    <div wire:ignore.self class="modal" id="modal-user-show" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Usuario {{$model->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <b>{{__("Nombre: ")}} </b>
                            {{$model->name}}
                        </li>
                        <li class="list-group-item">
                            <b>{{__("Email: ")}} </b>
                            {{$model->email}}
                        </li>
                        <li class="list-group-item">
                            <b>{{__("Rol: ")}} </b>
                            {{$model->rol}}
                        </li>
                    </ul>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
