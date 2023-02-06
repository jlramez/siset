<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Registro</h5>
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
                <label for="ap"></label>
                <input wire:model="ap" type="text" class="form-control" id="ap" placeholder="Primer Apellido">@error('ap') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="am"></label>
                <input wire:model="am" type="text" class="form-control" id="am" placeholder="Segundo Apellido">@error('am') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="edad"></label>
                <input wire:model="edad" type="text" class="form-control" id="edad" placeholder="Edad">@error('edad') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="centros_id" ></label>
                                  <select wire:model="centros_id" name="centros_id" id="centros_id" class="form-control">
                                     <option>--Seleccione el centro de atención--</option>  
                    
                                      <option  value="1">Centro de atención Fresnillo</option>
                                      <option  value="2">Centro de atención Zacatecas</option>
                                      <option  value="3">Centro de atención Refugio</option>
                                </select> 
             </div>
            <div class="form-group ">
                            <label for="primera_vez" ></label>
                                  <select wire:model="primera_vez" name="primera_vez" id="primera_vez" class="form-control">
                                     <option>--Seleccione si es primera vez / subsecuente--</option>  
                    
                                      <option  value="1">Primera vez</option>
                                      <option  value="2">Subsecuente</option>
                                  
                                </select> 
             </div>
    
            <div class="form-group ">
                            <label for="servicios" ></label>
                                  <select wire:model="servicios_id" name="servicios_id" id="servicios_id" class="form-control">
                                     <option>--Seleccione un servicio--</option>  
                                     @foreach ($rss as $servicio) 
                                      <option  value="{{ $servicio->id }}">{{ $servicio->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
            <div class="form-group">
                <label for="Observaciones"></label>
                <input wire:model="Observaciones" type="text" class="form-control" id="Observaciones" placeholder="Observaciones">@error('Observaciones') <span class="error text-danger">{{ $message }}</span> @enderror
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
