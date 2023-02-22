<style>
    .text-semujer {
  color: #781005 !important;
}

</style>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/img/favicon.png') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js"></script>
    <script type="text/javascript">
                baseURL={!! json_encode(url('/')) !!}
    </script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	 @livewireStyles
</head>
<body>
    <div id="app">
    <div  align="center">
      <img name="index_r1_c1" src="header/c_siset_3b.jpg" width="1280" height="200" border="0" alt="">
    </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-calendar text-semujer" ></i>  Agenda
					</button>
                            <ul class="dropdown-menu">
									<a href="{{ url('/evento/1') }}" class="dropdown-item "> <i class="fa fa-calendar text-semujer"></i> Despacho de la Secretaria</a>
									<a  href="{{ url('/evento/21') }}" class="dropdown-item " ><i class="fa fa-calendar text-semujer"></i> Secretaría Técnica</a>
									<a href="{{ url('/evento/6') }}" class="dropdown-item "><i class="fa fa-Calendar text-semujer"></i> Coordinación Administrativa</a>											 
                                    <a href="{{ url('/evento/3') }}" class="dropdown-item"> <i class="fa fa-calendar text-semujer"></i> Unidad de Planeación</a>
									<a href="{{ url('/evento/9') }}" class="dropdown-item" ><i class="fa fa-calendar text-semujer"></i> Subs Derecho Mujeres</a>
									<a href="{{ url('/evento/27') }}" class="dropdown-item"><i class="fa fa-Calendar text-semujer"></i> Dirección de At Mujeres Victimas Volemcia </a>
                                    <a href="{{ url('/evento/7') }}" class="dropdown-item "> <i class="fa fa-calendar text-semujer"></i>Direccion de empoderamiento económico</a>
									<a href="{{ url('/evento/26') }}" class="dropdown-item" ><i class="fa fa-calendar text-semujer"></i>Subsecretaria para la igualdad sustantiva</a>
									<a href="{{ url('/evento/5') }}" class="dropdown-item"><i class="fa fa-Calendar text-semujer"></i> Dirección de Transversalización </a>
                                    <a href="{{ url('/evento/28') }}" class="dropdown-item"> <i class="fa fa-calendar text-semujer"></i> Dirección de Institucionalización</a>
									<a href="{{ url('/evento/8') }}" class="dropdown-item" ><i class="fa fa-calendar text-semujer"></i>Dirección Jurídica</a>
									<a href="{{ url('/evento/29') }}" class="dropdown-item"><i class="fa fa-Calendar text-semujer"></i> Dirección de capacitación e Investigación</a>
                                    <a href="{{ url('/evento/2') }}" class="dropdown-item"> <i class="fa fa-calendar text-semujer"></i> BANEVIM</a>
                                </ul>
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
                       
		
                        <!--<li class="nav-item">
                            <a href="{{ url('/evento') }}" class="nav-link"><i class="fas fa-calendar text-semujer"></i> Agenda</a> 
                        </li>-->
						<li class="nav-item">
                            <a href="{{ url('/registros') }}" class="nav-link"><i class="fas fa-address-card text-semujer"></i> Registro</a> 
                        </li>
                        @can('home')
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link"><i class="fa fa-home text-semujer"></i> Tablero General</a> 
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ url('/homeuser') }}" class="nav-link"><i class="fa fa-home text-semujer"></i> Tablero</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/users') }}" class="nav-link"><i class="fas fa-users text-semujer"></i> Users</a> 
                        </li>
                        @can('permisos.index')
						<li class="nav-item">
                            <a href="{{ url('/permissions') }}" class="nav-link"><i class="fas fa-lock text-semujer"></i> Permisos</a> 
                        </li>
                        @endcan
                        @can('roles.index')
						<li class="nav-item">
                            <a href="{{ url('/roles') }}" class="nav-link"><i class="fas fa-user-lock text-semujer"></i> Roles</a> 
                        </li>
                        @endcan
                        @can('estados.index')
						<li class="nav-item">
                            <a href="{{ url('/estados') }}" class="nav-link"><i class="fas fa-check text-semujer"></i> Estados</a> 
                        </li>
                        @endcan
						@can('atareas.index')
						<li class="nav-item">
                            <a href="{{ url('/atareas') }}" class="nav-link"><i class="fas fa-list text-semujer"></i> T. asignadas</a> 
                        </li>
                        @endcan
                        @can('tareas.index')
						<li class="nav-item">
                            <a href="{{ url('/tareas') }}" class="nav-link"><i class="fas fa-briefcase text-semujer"></i> Tareas</a> 
                        </li>
                        @endcan
                        @can('prioridades.index')
						<li class="nav-item">
                            <a href="{{ url('/prioridades') }}" class="nav-link"><i class="fas fa-check-double text-semujer"></i> Prioridades</a> 
                        </li>
                        @endcan
                        @can('actividades.index')
						<li class="nav-item">
                            <a href="{{ url('/actividades') }}" class="nav-link"><i class="fas fa-laptop text-semujer"></i> Actividades</a> 
                        </li>
                        @endcan
                        @can('puestos.index')
						<li class="nav-item">
                            <a href="{{ url('/puestos') }}" class="nav-link"><i class="fas fa-clipboard-list text-semujer"></i> Puestos</a> 
                        </li>
                        @endcan
                        @can('areas.index')
						<li class="nav-item">
                            <a href="{{ url('/areas') }}" class="nav-link"><i class="fas fa-location-arrow text-semujer"></i> Areas</a> 
                        </li>
                        @endcan
                        @can('empleados.index')
						<li class="nav-item">
                            <a href="{{ url('/empleados') }}" class="nav-link"><i class="fas fa-user text-semujer"></i> Empleados</a> 
                        </li>
                        @endcan
                    </ul>
					@endauth()
					
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <script src="{{ asset('js/agenda.js') }}"></script>
        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
    @livewireScripts
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#createDataModal').modal('hide');
	});
    window.livewire.on('closeModal', () => {
		$('#addempDataModal').modal('hide');
	});
    window.livewire.on('closeModal', () => {
		$('#adduserDataModal').modal('hide');
	});
    window.livewire.on('closeModal', () => {
		$('#addpermissionModal').modal('hide');
	});
    window.livewire.on('closeModal', () => {
		$('#updatepermissionModal').modal('hide');
	});
    window.livewire.on('closeModal', () => {
		$('#addestadoDataModal').modal('hide');
	});
</script>
</body>
</html>
