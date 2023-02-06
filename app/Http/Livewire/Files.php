<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\Afile;

class Files extends Component
{
    use WithFileUploads;
    public $files=[];
    public $tareas;
    public function mount($id_tarea)
    {
     $this->id_tarea = $id_tarea;
    }

    protected $rules=
    [
        'files.*'=>
         [
            'required',
            'mimes:pdf,doc,docx,jpg,jpeg,png'
         ]
    ];
    public function save()
    {
        //dd($this->id_tarea);
        $this->validate();
        foreach($this->files as $key=>$file)
        {
            $file_save=new file();
            $file_save->file_name=$file->getClientOriginalName();
            $file_save->file_extension=$file->extension();
            $file_save->file_path='storage/'.$file->store('files','public');
            $file_save->save();
            $file_assign=new Afile();
            $file_assign->id_files= File::max('id');
            $file_assign->id_tareas= $this->id_tarea;
            $file_assign->id_users=auth()->user()->id;
            $file_assign->save();

        }    
        return redirect()->route('tareas.show',$this->id_tarea);

    }
  
    public function render()
    {
        return view('livewire.files.create')
        ->extends('layouts.app')
        ->section('content');
    }
}
