@section('title', __('Empleados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-user text-semujer"></i>
							Listado de Empleados </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Empleados">
						</div>
						@can('empleados.index')
						<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Empleado
						</div>
						@endcan
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.empleados.create')
						@include('livewire.empleados.update')
						@include('livewire.empleados.adduser')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Ap</th>
								<th>Am</th>
								<th>Puesto</th>
								<th>Correo electrónico</th>
								<th>Usuario</th>
								<th>ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@foreach($empleados as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->ap }}</td>
								<td>{{ $row->am }}</td>
								<td>{{ $row->puesto->descripcion }}</td>
								<td>{{ $row->email }}</td>
								
								 <td>{{ $row->usuario->email ?? 'sin asignar'}}</td>								
			
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#adduserDataModal" class="dropdown-item" wire:click="adduser({{$row->id}})"><i class="fa fa-user"></i> Asignar usuario</a>
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Empleado id {{$row->id}}? \nDeleted Empleados cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $empleados->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
