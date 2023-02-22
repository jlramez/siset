@extends('layouts.app')
@section('title', __('Tablero de control por usurio'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-semujer fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5><strong>{{ Auth::user()->name }},</strong> {{ __('El avance de sus  actividades asignadas es el siguiente:') }}{{ config('app.name', 'Laravel') }}</h5>
				</br> 
				<hr>
				
			<div class="row w-100" >
					<div class="col-md-4">
						<div class="card border-success mx-sm-1 p-3">
							<div class="card border-success text-success p-3 my-card"><span class="text-center fas fa-check" style="font-size:36px" aria-hidden="true"></span></div>
							<div class="text-success text-center mt-3"><h4>Tareas realizadas</h4></div>
							<div class="text-success text-center mt-2"><h1>{{$cumpl}}</h1></div>
							<!--<div class="text-warning text-center mt-2">
							<a href="{{route('show_done.index')}}" class="btn btn-success">Ver tareas</a></div>	-->				
						</div>
					</div>
					<div class="col-md-4">
						<div class="card border-warning mx-sm-1 p-3">
							<div class="card border-warning text-warning p-3 my-card" ><span class="text-center fas fa-upload" style="font-size:36px" aria-hidden="true"></span></div>
							<div class="text-warning text-center mt-3"><h4>Tareas en proceso</h4></div>
							<div class="text-warning text-center mt-2"><h1>{{ $en_pro}}</h1></div>
							<!--<div class="text-warning text-center mt-2"><button type="button" class="btn btn-warning">Ver tareas</button></div>-->

						</div>
					</div>
					<div class="col-md-4">
						<div class="card border-danger mx-sm-1 p-3">
							<div class="card border-danger text-danger p-3 my-card" ><span class="text-center fa"  style="font-size:36px" aria-hidden="true">&#xf00d</span></div>
							<div class="text-danger text-center mt-3"><h4>Tareas pendientes</h4></div>
							<div class="text-danger text-center mt-2"><h1>{{$no_cumpl }}</h1></div>
							<!--<div class="text-warning text-center mt-2"><a href="{{route('tareaspendientes.index')}}" class="btn btn-danger">Ver tareas</a></div>-->

						</div>
					</div>
				
				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection