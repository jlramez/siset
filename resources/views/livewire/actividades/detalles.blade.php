@section('title', __('Detalles'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-info text-semujer"></i> 
							Descripción de la actividad </h4>
						</div>				
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }}
					    </div>
						aqui!!!!
						
						@endif
					</div>
				</div>
				
				<div class="card-body">						
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
					    <th> <colspan="2" > <h5 style="color:#781005">Información de la actividad</h5></th>
						<th style="text-align:right">
						<a href="{{ url('/tasks',$actividades->id) }}" class="btn btn-sm btn-secondary" title="detalles" ><i class="fas fa-eye"></i> Ver tareas</a>
                        </th>
						</thead>
						<tbody>
							<tr>
								<td>Actividad:</td><td>{{ $actividades->nombre}}</td>
							</tr>
								<td>Descripción:</td><td>{{ $actividades->descripción }}</td>
								@if($actividades->prioridades->id==1)
									<tr>
										<td>Prioridad:</td><td><span class="badge badge-danger">{{ $actividades->prioridades->descripcion }}</span></td>				
									</tr>
								@endif
								@if($actividades->prioridades->id==2)
									<tr>		
										<td>Prioridad:</td><td><span class="badge badge-warning">{{ $actividades->prioridades->descripcion }}</span></td>				
									</tr>
								@endif
								@if($actividades->prioridades->id==3)
								<tr>
								<td>Prioridad:</td><td><span class="badge badge-success">{{ $actividades->prioridades->descripcion }}</span></td>				
								</tr>
								@endif
								@if($actividades->avance)
										
										@if($actividades->avance>=0 && $actividades->avance<=50)
											<tr>
											<td>Avance:</td><td><span class="badge badge-danger">{{ $actividades->avance}} %</span></td>				
											</tr>
										@endif
										@if($actividades->avance>=51 && $actividades->avance<=70)
											<tr>
												<td>Avance:</td><td><span class="badge badge-warning">{{ $actividades->avance }} %</span></td>				
											</tr>
										@endif
										@if($actividades->avance>=71 && $actividades->avance<=100)
											<tr>
												<td>Avance:</td><td><span class="badge badge-success">{{ $actividades->avance }} %</span></td>				
											</tr>
										@endif
								@endif 
								@if ($actividades->avance==null || $actividades->avance==0)
											<tr>
											<td>Avance:</td><td><span class="badge badge-danger">{{ $actividades->avance ?? '0'}} %</span></td>				
											</tr>
										@endif
								<tr><td>Responsable(s)</td><td>
								@foreach($atareas as $row)
								<span class="badge badge-secondary">{{$row->empleados->nombre}} 
									{{$row->empleados->ap}} {{$row->empleados->am}}</span>
								@endforeach 
								</td></tr> 
									</div>
								</div>
								</td>
						</tbody>
					</table>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>