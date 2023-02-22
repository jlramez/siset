@section('title', __('Detalles Tareas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-info text-semujer"></i> 
							Descripción de la tarea </h4>
						</div>				
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }}
					    </div>						
						@endif
					</div>
				</div>
				
				<div class="card-body">						
				<div class="table-responsive">

					<table class="table table-striped" border="0">
						<thead>
					<th> <colspan="2" > <h5 style="color:#781005">Información de la tarea</h5></th>
					<th style="text-align:right">
						@if ($nuevos)
							<a href="{{route('comentarios.show',$tareas->id)}}" class="btn btn-light text-semujer">
								Observaciones <span class="badge badge-dark">{{$cuantos}}</span></a>							
							<span class="badge badge-danger">¡Nueva!</span>
							@else
									<a href="{{route('comentarios.show',$tareas->id)}}" class="btn btn-light text-semujer">
									Observaciones <span class="badge badge-dark">{{$cuantos}}</span>
						@endif
					</th>
						<th style="text-align:right">
						<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									...
						</button>
						<div class="dropdown-menu dropdown-menu-right">
									<a href="{{route('files.index',$tareas->id)}}" class="dropdown-item"><i class="fa fa-paperclip"></i> Adjuntr archivo</a>
									<a href="{{route('comentarios.index',$tareas->id)}}" class="dropdown-item"><i class="fas fa-comment"></i> Agregar observaciones</a>											  
				        </div>                       
					 </th>
						</thead>
						<tbody>
							<tr>
								<td>Tarea:</td><td colspan="2">{{ $tareas->descripcion}}</td>
							</tr>
							<tr>
								<td>Actividad:</td><td colspan="2">{{ $tareas->actividades->descripción}}</td>
							</tr>
							<tr>
								<td>Estátus:</td><td colspan="2"><span class="badge badge-success">{{ $tareas->estados->descripcion}}</span></td>
							</tr>
							<tr>
								<td>Inicio:</td><td colspan="2">{{ $tareas->created_at}}</td>
							</tr>
								<td>Fin:</td><td colspan="2">{{ $tareas->ended_at}}</td>
							</tr>
							</tr>
								<td colspan="3">
									<div class="card-header">
										<h5 style="color:#781005">Archivos adjuntos</h5>
									</div>
								     <table class="table table-striped" width="100%">
										<th>Archivo</th>
										<th>Extensión<noscript></noscript></th>
										<th>Author</th>
										<th>Preview</th>
										<th>Eliminar</th>
										@foreach($afiles as $row)
											<tr>
												<td>{{ $row->files->file_name}}</td>
												<td>{{ $row->files->file_extension}}</td>
												<td>{{ $row->users->name}}</td>
												<td>
													@if (($row->files->file_extension =='pdf') || ($row->files->file_extension == 'docx'))
														<a href="{{asset($row->files->file_path)}}" target="_blank">
														Ver Archivo</a>
														@else
															<img src="{{asset($row->files->file_path)}}" width="150" height="150" class="img-fluid"></img>
												    @endif
													</td>
												<td>
												<a  onclick="confirm('Deseas eliminar el archivo id {{$row->id}}? \n¡Los archivos eliminados no se podrán recuperar!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										@endforeach
									 </table>
								</td>
							</tr>
			
						</tbody>
					</table>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>