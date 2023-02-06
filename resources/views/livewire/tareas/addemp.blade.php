<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addempDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addempDataModalLabel">Asignar empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
                <input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="actividades_id"></label>
                <input wire:model="actividades_id" type="text" class="form-control" id="actividades_id" placeholder="Actividades Id">@error('actividades_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descripcion"></label>
                <input wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Tareas ">@error('tareas_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="empleados_id" ></label>
                                  <select wire:model="empleados_id" name="empleados_id" id="empleados_id" class="form-control">
                                     <option>--Seleccione un empleado--</option>  
                                     @foreach ($empleados as $row) 
                                      <option  value="{{ $row->id }}">{{ $row->nombre }}</option>
                                     @endforeach
                                </select> 
             </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="storemp()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>