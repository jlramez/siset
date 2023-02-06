@section('title', __('Atareas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-list text-semujer"></i>
							Listado de Tareas asignadas </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Atareas">
						</div>
						<!--<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Asignar Tarea
						</div>-->
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.atareas.create')
						@include('livewire.atareas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Actividad</th>
								<th>Tarea</th>
								<th>Empleado Responsable</th> 
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($atareas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->tareas->actividades->nombre }}</td>
								<td>{{ $row->tareas->descripcion}}</td>
								<td>{{ $row->empleados->nombre}}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="detalles({{$row->id}})"><i class="fas fa-paperclip"></i> Adjuntar archivo</a>
									<a class="dropdown-item" onclick="confirm('Confirm Delete Atarea id {{$row->id}}? \nDeleted Atareas cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $atareas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
