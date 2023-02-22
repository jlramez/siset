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
						<!--<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>-->
						<div >
							<input type="text" class="form-control" id="search" placeholder="Buscar tareas ...">
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						
						<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Nueva tarea (propia)
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.atareas.create')
						@include('livewire.atareas.update')
						@include('livewire.tareas.addestado')
				<div class="table-responsive">
					<table class="table table-bordered table-sm" id="tabla-output">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Tarea</th>
								<th>Actividad</th>														
								<th>Empleado Responsable</th> 
								<th>Fecha  limite</th>	
								<th>Estado</th>
								<th>Detalles</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($atareas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 								
								<td>{{ $row->tareas->descripcion}}</td>
								<td>{{ $row->tareas->actividades->nombre }}</td>
								<td>{{ $row->empleados->nombre}} {{ $row->empleados->ap}} {{ $row->empleados->am}}</td>
								<td>{{ $row->tareas->fecha_entrega}}</td>
								@if($row->tareas->estados->id==1)
								<td><span class="badge badge-danger">{{ $row->tareas->estados->descripcion }}</span></td>				
								@endif
								@if($row->tareas->estados->id==2)
								<td><span class="badge badge-success">{{ $row->tareas->estados->descripcion }}</span></td>				
								@endif
								@if($row->tareas->estados->id==3)
								<td><span class="badge badge-warning">{{ $row->tareas->estados->descripcion }}</span></td>				
								@endif								
								<td style="text-align:center"><a href="{{ route('tareas.show',$row->tareas->id) }}" class="btn btn-sm btn-secondary" title="detalles" ><i class="fas fa-eye"></i> Ver</a></td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>

									<div class="dropdown-menu dropdown-menu-right">
									@role(['admin','secretaria','sub_secretaria','director'])
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>
									@endrole									
									<a data-toggle="modal" data-target="#addestadoDataModal" class="dropdown-item" wire:click="addestado({{$row->id}})"><i class="fa fa-check"></i> Asignar Estátus</a>							
									@role(['admin','secretaria','sub_secretaria','director'])
									<a class="dropdown-item" onclick="confirm('Confirm Delete Atarea id {{$row->id}}? \nDeleted Atareas cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a> 
									@endrole  
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
