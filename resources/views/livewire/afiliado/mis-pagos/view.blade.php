@section('title', __('Mis pagos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<h4>
						Pagos
						<div wire:loading wire:target="search" style="display: none" class="spinner-border spinner-border-sm"
							role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</h4>
				</div>
				<div class="col-xs-12 col-md-6 text-end">
					<h3>
						Total: {{$totalPagos}} Bs.
					</h3>
				</div>
			</div>
			@include('livewire.afiliado.mis-pagos.show')
			<div class="table-responsive mb-3">
				<table class="table align-middle table-bordered table-hover table-row-pointer">
					<thead class="table-light">
						<tr> 
							<th>ID</th> 
							<th>Total (Bs.)</th>
							<th>Registrado por</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Con matricula</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@if (count($pagoMatriculas) > 0)
							@foreach($pagoMatriculas as $row)
								<tr onclick="onSelectMiPago({{$row->id}}, this, event)" title="Seleccionar Pago">
									<td>{{ $row->id }}</td> 
									<td>
										<b>
											{{ $row->total }}
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
										@if($row->pagoMatricula)
											{{ $row->pagoMatricula->monto }}
										@endif
									</td>
									<td>
										<div class="dropstart">
											<button class="btn dropdown-toggle" type="button" id="pago_dropdownActions" data-bs-toggle="dropdown"
												aria-expanded="false">
												<i class="bi bi-three-dots-vertical"></i>
											</button>
											<ul class="dropdown-menu" aria-labelledby="pago_dropdownActions">
												<li>
													<button type="button" wire:click="browserPrint({{$row->id}})" class="dropdown-item">
														<i class="bi bi-printer"></i> 
															Imprimir
													</button>
												</li>
												<li>
													<button type="button" wire:click="show({{$row->id}})" class="dropdown-item">
														<i class="bi bi-pencil"></i> 
															Ver
													</button>
												</li>
												<li>
													<button type="button" onclick="destroyMiPago({{$row->id}})" class="dropdown-item" type="button">
														<i class="bi bi-trash"></i> Eliminar 
													</button>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="7" class="text-center">
									No hay resultados
								</td>
							</tr>
						@endif
					</tbody>
				</table>						
				{{ $pagoMatriculas->links() }}
			</div>
		</div>
			
	</div>
	<x-page.loading />
	@push('scripts')
		<script>
			function onSelectMiPago(idPago, element, event) {
				if($(event.target).is('td, th, span')) {
					@this.show(idPago)
					$('tr').removeClass('table-secondary');
					$(element).addClass('table-secondary');
				}
			}

			function destroyMiPago(id) {
				Swal.fire({
					title: "Pago",
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
</div>
