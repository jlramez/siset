@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <livewire:comentarios.show :id_tarea="$id_tarea">  
        </div>     
    </div>   
</div>
@endsection
