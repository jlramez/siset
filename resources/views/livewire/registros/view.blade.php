@section('title', __('Registros'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							hola </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Registros">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.registros.create')
						@include('livewire.registros.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Centro de atención</th> 
								<th>Nombre</th>
								<th>Ap</th>
								<th>Am</th>
								<th>Edad</th>
								<th>Primera Vez</th>
								<th>Servicio</th>
								<th>Observaciones</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($registros as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->centros->descripcion }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->ap }}</td>
								<td>{{ $row->am }}</td>
								<td>{{ $row->edad }}</td>
                             
								@if($row->primera_vez===1)
									<td>1a. vez</td>
								@endif
								@if($row->primera_vez===2)
										<td>Subsecuente</td>
								@endif
								<td>{{ $row->servicios->descripcion}}</td>
								<td>{{ $row->Observaciones }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Registro id {{$row->id}}? \nDeleted Registros cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $registros->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
