@section('title', __('Actividades'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-laptop text-semujer"></i>
							Listado de Actividades </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Actividades">
						</div>
						<div class="btn btn-sm btn-success" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Actividades
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.actividades.create')
						@include('livewire.actividades.update')
						
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-sm">
						<thead class="table-secondary">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Área responsable</th>
								<th>Detalles</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($actividades as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->areas->descripcion }}</td>
				                <td align="center"><a href="{{ route('detalles.index',$row->id) }}" class="btn btn-sm btn-secondary" title="detalles" ><i class="fas fa-eye"></i> Ver detalles</a></td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<!--<a class="dropdown-item" wire:click="calculate({{$row->id}})"><i class="fa fa-calculator"></i> Calcular avance </a>	-->
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Actividade id {{$row->id}}? \nDeleted Actividades cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $actividades->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
