<!-- Modal -->
<div wire:ignore.self class="modal fade" id="adduserDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="adduserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adduserModalLabel">Actualizar Empleado</h5>
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
            <div class="form-group ">
                            <label for="puestos" ></label>
                                  <select wire:model="users_id" id="users_id" class="form-control" name="users_id" >
                                     <option>--Seleccione el usuario--</option>  
                                     @foreach ($rsu as $user) 
                                      <option  value="{{ $user->id }}">{{ $user->name }}</option>
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
                <button type="button" wire:click.prevent="updateadduser()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>
<script>
document.addEventListener('livewire:load',function() {
    $('.select2').select2();
    $('.select2').on('change',function(){
        alert(this.value)
        $(this).blur()
    });
})
</script>

