<style>
    .btn-s {
  color: #fffff;
  background-color: #781005;
  border-color: #781005;
}

.btn-s:hover {
  color: #c6c6c6;
  background-color: #4aa0e6;
  border-color: #3f9ae5;
}

.btn-s:focus,
.btn-s.focus {
  color: #fff;
  background-color: #4aa0e6;
  border-color: #3f9ae5;
  box-shadow: 0 0 0 0.2rem rgba(97, 157, 206, 0.5);
}

.btn-s.disabled,
.btn-s:disabled {
  color: #212529;
  background-color: #6cb2eb;
  border-color: #6cb2eb;
}

.btn-s:not(:disabled):not(.disabled):active,
.btn-s:not(:disabled):not(.disabled).active,
.show > .btn-s.dropdown-toggle {
  color: #fff;
  background-color: #3f9ae5;
  border-color: #3495e3;
}

.btn-s:not(:disabled):not(.disabled):active:focus,
.btn-s:not(:disabled):not(.disabled).active:focus,
.show > .btn-s.dropdown-toggle:focus {
  box-shadow: 0 0 0 0.2rem rgba(97, 157, 206, 0.5);
}
    .btn-semujer {
  color: #ffffff;
  background-color: #781005;
  border-color: #781005;
}
.btn-semujer:hover {
  color: #c6c6c6;
  background-color: #781005;
  border-color: #781005;
}
.card-header-semujer {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(120, 16, 5, 0.7);
  border-bottom: 1px solid rgba(54, 112, 104, 0.125);
  color: #ffffff
}
textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
p {
                  
                    line-height: 50%   /*esta es la propiedad para el interlineado*/
                   
                }
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header-semujer">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="rol-user" class="col-md-4 col-form-label text-md-end">{{ __('Rol de usuario') }}</label>
                            
                            <div class="col-md-6"">
                                    <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" required autocomplete="rol_id" >
                                        <option>--Seleccione un rol--</option>  
                                        <option  value="1">admin</option>
                                        <option  value="2">manager</option>
                                        <option  value="3">user</option>
                                    </select> 
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-semujer">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
