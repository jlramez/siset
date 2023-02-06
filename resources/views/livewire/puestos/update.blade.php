<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Puesto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="nomenclatura"></label>
                <input wire:model="nomenclatura" type="text" class="form-control" id="nomenclatura" placeholder="Nomenclatura">@error('nomenclatura') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descripcion"></label>
                <input wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion">@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <!--<div class="form-group">
                <label for="areas_id"></label>
                <input wire:model="areas_id" type="text" class="form-control" id="areas_id" placeholder="Areas Id">@error('areas_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>-->
            <div class="form-group ">
                            <label for="areas" ></label>
                                  <select wire:model="areas_id" name="areas_id" id="areas_id" class="form-control">
                                     <option>--Seleccione el área--</option>  
                                     @foreach ($areas as $area) 
                                      <option  value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Eliminar</button>
            </div>
       </div>
    </div>
</div>
