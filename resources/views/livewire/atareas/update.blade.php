<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Atarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="actividades_id"></label>
                <input wire:model="actividades_id" type="text" class="form-control" id="actividades_id" placeholder="Actividades Id">@error('actividades_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="Actividades_id" ></label>
                                  <select wire:model="actividades_id" name="actividades_id" id="actividades_id" class="form-control">
                                     <option>--Seleccione la actividad--</option>  
                                     @foreach ($actividad as $actividad) 
                                      <option  value="{{ $actividad->id }}">{{ $actividad->descripción }}</option>
                                     @endforeach
                                </select> 
             </div>
            <div class="form-group">
                <label for="tareas_id"></label>
                <input wire:model="tareas_id" type="text" class="form-control" id="tareas_id" placeholder="Tareas Id">@error('tareas_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="tareas_id" ></label>
                                  <select wire:model="tareas_id" name="tareas_id" id="tareas_id" class="form-control">
                                     <option>--Seleccione la tarea--</option>  
                                     @foreach ($tarea as $tarea) 
                                      <option  value="{{ $tarea->id }}">{{ $tarea->descripcion }}</option>
                                     @endforeach
                                </select> 
             </div>
            <div class="form-group">
                <label for="empleados_id"></label>
                <input wire:model="empleados_id" type="text" class="form-control" id="empleados_id" placeholder="Empleados Id">@error('empleados_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group ">
                            <label for="empleados_id" ></label>
                                  <select wire:model="empleados_id" name="em" id="empleados_id" class="form-control">
                                     <option>--Seleccione el  empleado--</option>  
                                     @foreach ($emp as $empleado) 
                                      <option  value="{{ $empleado->id }}">{{ $empleado->nombre}}</option>
                                     @endforeach
                                </select> 
             </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>
