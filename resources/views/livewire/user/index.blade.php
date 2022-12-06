<div>
    @section('title', 'Usuarios')
    @section('breadcrumbs', Breadcrumbs::render('users') )
    
    <div class="text-end">
        <button wire:click="$emitTo('user.create', 'openModal')" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Nuevo
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->rol_name}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                    <button type="button" wire:click="$emitTo('user.show', 'setUser', {{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>
                                <li>
                                    <button type="button" wire:click="$emitTo('user.edit', 'setUser', {{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="destroyUser({{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </li>
    
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (count($data) > 0)
        <div class="row mb-3">
            <div class="col-xs-12 col-md-6">
                <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                    de {{$data->total()}} registros
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="btn-group float-end">
                    {{$data->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif
    <x-page.loading />
    <livewire:user.create wire:key="user-create">
    <livewire:user.edit wire:key="user-edit">
    <livewire:user.show wire:key="user-show">
</div>

@push('scripts')
    <script>
        function destroyUser(id) {
            Swal.fire({
                title: "Usuario",
                text: "¿ Esta seguro de eliminar este elemento ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Si, eliminalo !'
            }).then((result) => {
                if (result.isConfirmed) {
                @this.destroy(id);
                }
            })
        }
    </script>
@endpush
