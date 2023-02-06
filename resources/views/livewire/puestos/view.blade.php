@section('title', __('Puestos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-clipboard-list text-semujer"></i>
							Listado de Puestos </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Puestos">
						</div>
						<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Puesto
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.puestos.create')
						@include('livewire.puestos.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nomenclatura</th>
								<th>Descripcion</th>
								<th>Área</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($puestos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nomenclatura }}</td>
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->area->descripcion }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">				 

									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Puesto id {{$row->id}}? \nDeleted Puestos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $puestos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
