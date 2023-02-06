<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descripción"></label>
                <input wire:model="descripción" type="text" class="form-control" id="descripción" placeholder="Descripción">@error('descripción') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="prioridad" ></label>
                                  <select wire:model="id_prioridad" name="id_prioridad" id="id_prioridad" class="form-control">
                                     <option>--Seleccione la  prioridad--</option>  
                                     @foreach ($rsp as $prioridad) 
                                      <option  value="{{ $prioridad->id }}">{{ $prioridad->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
            <div class="form-group ">
                            <label for="areas" ></label>
                                  <select wire:model="areas_id" name="areas_id" id="areas_id" class="form-control">
                                     <option>--Seleccione el area--</option>  
                                     @foreach ($rsa as $area) 
                                      <option  value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-success" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>
