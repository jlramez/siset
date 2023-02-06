@section('title', __('Tareas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-briefcase text-semujer"></i>
							Listado de Tareas</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Tareas">
						</div>
						<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Tareas
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.tareas.create')
						@include('livewire.tareas.update')
						@include('livewire.tareas.addemp')
						@include('livewire.tareas.addestado')

				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<form>
							<input type="hidden" wire:model="selected_id">
                            </form>
							<tr> 
								<td>#</td> 
								<th>Descripcion</th>
								<!--<th>Actividad </th>
								<th>Fecha inicio</th>
								<th>Fecha  fin</th>-->
								<th>Estado</th>
								<th>Detalles</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($tareas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->descripcion }}</td>								
								<!--<td>{{ $row->actividades->nombre}}</td>
								<td>{{ $row->created_at}}</td>
								<td>{{$row->ended_at}}</td>-->
								@if($row->estados->id==1)
								<td><span class="badge badge-danger">{{ $row->estados->descripcion }}</span></td>				
								@endif
								@if($row->estados->id==2)
								<td><span class="badge badge-success">{{ $row->estados->descripcion }}</span></td>				
								@endif
								@if($row->estados->id==3)
								<td><span class="badge badge-warning">{{ $row->estados->descripcion }}</span></td>				
								@endif
								<td style="text-align:center"><a href="{{ route('tareas.show',$row->id) }}" class="btn btn-sm btn-secondary" title="detalles" ><i class="fas fa-eye"></i> Ver detalles</a></td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#addempDataModal" class="dropdown-item" wire:click="addemp({{$row->id}})"><i class="fa fa-user"></i> Asignar Empleado</a>
									<a data-toggle="modal" data-target="#addestadoDataModal" class="dropdown-item" wire:click="addestado({{$row->id}})"><i class="fa fa-check"></i> Asignar Estátus</a>		
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>					 
									<!--<a class="dropdown-item" wire:click="checked({{$row->id}})"><i class="fa fa-check"></i> Realizada (Si/No) </a>-->							 							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Tarea id {{$row->id}}? \nDeleted Tareas cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $tareas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
