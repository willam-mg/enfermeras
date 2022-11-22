@section('title', __('Pago Matriculas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<label>Total</label>
							<h4>{{$total}} Bs.</h4>
						</div>
						<div class="col-xs-12 col-md-3">
							<label>Total pagos</label>
							<h4>{{$totalPagos}} Bs.</h4>
						</div>
						<div class="col-xs-12 col-md-3">
							<label>Saldo</label>
							<h4>{{$saldo}} Bs.</h4>
						</div>
						<div class="col-xs-12 col-md-3 pt-3">
							@if ($saldo > 0)
								<h3 class="text-danger">
									Pendiente
								</h3>
							@else
								<h3 class="text-success">
									<i class="bi bi-check2"></i> Cancelado
								</h3>
							@endif
						</div>
					</div>
					<hr>
					<div class="mb-3" style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-right">
							<b>Pagos</b>
						</div>
						<button type="button" class="btn btn-success" onclick="$('#modal-pagomatricula-create').modal('show')" {{$saldo  == 0?'disabled':''}}>
							<i class="bi bi-plus"></i>  Nuevo pago
						</button>
						
					</div>
					@include('livewire.pago-matriculas.create')
					@include('livewire.pago-matriculas.update')
					<div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<th>ID</th> 
									<th>Monto (Bs.)</th>
									<th>Registrado por</th>
									<th>Fecha</th>
									<th>Hora</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($pagoMatriculas as $row)
								<tr>
									<td>{{ $row->id }}</td> 
									<td>
										<b>
											{{ $row->monto }}
										</b>
									</td>
									<td>
										@if ($row->user)
											{{$row->user->name}}
										@else
											<x-page.noexists :value="$row->user_id" />
										@endif
									</td>
									<td>{{ $row->fecha }}</td>
									<td>{{ $row->hora }}</td>
									<td>
										<div class="dropstart">
											<button class="btn dropdown-toggle" type="button" id="pago_dropdownActions" data-bs-toggle="dropdown"
												aria-expanded="false">
												<i class="bi bi-three-dots-vertical"></i>
											</button>
											<ul class="dropdown-menu" aria-labelledby="pago_dropdownActions">
												<li>
													<button type="button" wire:click="edit({{$row->id}})" class="dropdown-item" wire:click="edit({{$row->id}})">
														<i class="bi bi-pencil"></i> 
															Editar
													</button>
												</li>
												<li>
													<button type="button" onclick="destroyPagoMatricula({{$row->id}})" class="dropdown-item" type="button">
														<i class="bi bi-trash"></i> Eliminar 
													</button>
												</li>
											</ul>
										</div>
									</td>
								@endforeach
							</tbody>
						</table>						
						{{ $pagoMatriculas->links() }}
						</div>
					</div>
			</div>
		</div>
	</div>
	@push('scripts')
		<script>
			function destroyPagoMatricula(id) {
				Swal.fire({
					title: "Pago matricula",
					text: "¿ Esta seguro de eliminar este elemnto ?",
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
</div>
