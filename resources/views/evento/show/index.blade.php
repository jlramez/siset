@extends('layouts.app')
@section('content')
<div class="container">
    <div id="agenda">Calendario</div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#evento">
  Launch
</button>

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Datos del evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
               
                    <form action="" id="formularioEventos">
                        {!! csrf_field() !!}
                        <input type="text" wire:model="selected_id">
                        <div class="form-group d-none">
                          <label for="">Id</label>
                          <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                         <!--<small id="helpId" class="form-text text-muted">Help text</small>-->
                        </div>
                        <div class="form-group">
                          <label for="">Titulo</label>
                          <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Escribe el título del evento">
                          <!--<small id="helpId" class="form-text text-muted">Help text</small>-->
                        </div>
                        <div class="form-group">
                          <label for="">Descripción del evento</label>
                          <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                        </div>
                        <div class="form-group d-none">
                          <label for="">Start</label>
                          <input type="date" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
                          <!--<small id="helpId" class="form-text text-muted">Help text</small>-->
                        </div>
                        <div class="form-group d-none">
                          <label for="">End</label>
                          <input type="date" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
                          <!--<small id="helpId" class="form-text text-muted">Help text</small>-->
                        </div>
                        <div class="form-group">
                          <label for="">areas_id</label>
                          <input type="text" class="form-control" name="areas_id" id="areas_id" aria-describedby="helpId" placeholder="">
                          <!--<small id="helpId" class="form-text text-muted">Help text</small>-->
                        </div>

                    </form> 
              
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
            <button type="button" class="btn btn-warning" id="btnUpdate">Actualizar</button>
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>
@endsection