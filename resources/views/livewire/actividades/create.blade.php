<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Nueva Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descripción"></label>
                <input wire:model="descripción" type="text" class="form-control" id="descripción" placeholder="Descripción">@error('descripción') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="id_prioridad "></label>
                                  <select wire:model="id_prioridad" name="id_prioridad" id="id_prioridad" class="form-control">
                                     <option>--Seleccione la prioridad--</option>  
                                     @foreach ($rsp as $prioridad) 
                                      <option  value="{{ $prioridad->id }}">{{ $prioridad->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
             <div class="form-group ">
                            <label for="areas_id "></label>
                                  <select wire:model="areas_id" name="areas_id" id="areas_id" class="form-control">
                                     <option>--Seleccione el área--</option>  
                                     @foreach ($rsa as $area) 
                                      <option  value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
          
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
