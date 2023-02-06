<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Empleado</h5>
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
                <label for="ap"></label>
                <input wire:model="ap" type="text" class="form-control" id="ap" placeholder="Ap">@error('ap') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="am"></label>
                <input wire:model="am" type="text" class="form-control" id="am" placeholder="Am">@error('am') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="curp"></label>
                <input wire:model="curp" type="text" class="form-control" id="curp" placeholder="Curp">@error('curp') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="rfc"></label>
                <input wire:model="rfc" type="text" class="form-control" id="rfc" placeholder="Rfc">@error('rfc') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <!--<div class="form-group">
                <label for="puestos_id"></label>
                <input wire:model="puestos_id" type="text" class="form-control" id="puestos_id" placeholder="Puestos Id">@error('puestos_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>-->
            <div class="form-group ">
                            <label for="puestos" ></label>
                                  <select wire:model="puestos_id" name="puestos_id" id="puestos_id" class="form-control">
                                     <option>--Seleccione el puesto--</option>  
                                     @foreach ($rsp as $puesto) 
                                      <option  value="{{ $puesto->id }}">{{ $puesto->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
            <div class="form-group">
                <label for="email"></label>
                <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>
