@section('title', __('Adjuntar aechivos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-paperclip text-semujer"></i>
							Adjuntar archivos </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Roles">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Roles
						</div>
					</div>
				</div>
				
				<div class="card-body">						
				    <div class="table-responsive">
						<form wire:submit.prevent="save">
                            <div class="form-group">
                                <label>Archivos</label>	
                                <input type="file" wire:model="files" class="form-control mb -2" multiple>
                                @error('file') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-danger">Adjuntar</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>