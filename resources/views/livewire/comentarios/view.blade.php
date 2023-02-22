@section('title', __('Observaciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-comment text-semujer"></i>
							Observaciones Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Estados">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Estados
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.estados.create')
						@include('livewire.estados.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
                                <th>Tarea</th>
                                <th>Author</th>
								<th>Contenido</th>
                                <th>Fecha</th>
								<td>Borrar</td>
							</tr>
						</thead>
						<tbody>
							@foreach($comentarios as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->tareas->descripcion }}</td>
                                <td>{{ $row->users->name }}</td>
                                <td>{{ $row->contenido }}</td>
                                <td>{{ $row->created_at }}</td>
								<td width="90">
								<a class="dropdown-item" onclick="confirm('Confirma eliminar comentario id {{$row->id}}? \Eliminar comentario no podra recuperarse!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $comentarios->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
