@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <livewire:detalles :id_actividad="$id_actividad">          
        </div>     
    </div>   
</div>
@endsection