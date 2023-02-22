@section('title', __('Detalles'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-info text-semujer"></i>
							Tareas de la actividad:</h4><h5><p style="color:#781005"></p> </h5>
						</div>
						
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif

					</div>
				</div>
				
				<div class="card-body">				
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<form>
							<input type="hidden" wire:model="selected_id">
                            </form>
							<tr> 
								<td>#</td> 
								<th>Descripcion</th>
								<th>Actividad</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tareas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->descripcion }}</td>								
								<td>{{ $row->actividades->nombre}}</td>
								@if($row->estados->id==1)
								<td><span class="badge badge-danger">{{ $row->estados->descripcion }}</span></td>				
								@endif
								@if($row->estados->id==2)
								<td><span class="badge badge-success">{{ $row->estados->descripcion }}</span></td>				
								@endif
								@if($row->estados->id==3)
								<td><span class="badge badge-secondary">{{ $row->estados->descripcion }}</span></td>				
								@endif
							@endforeach
						</tbody>
					</table>						
					{{ $tareas->links() }}
				</div>
			</div>
		</div>
	</div>
</div>