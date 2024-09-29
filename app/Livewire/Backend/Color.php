<?php

namespace App\Livewire\Backend;

use App\Models\Color as ModelsColor;
use Livewire\Component;

class Color extends Component
{
    public $id      = null;
    public $name    = null;
    public $code    = null;


    public function save()
    {
        if ($this->name == null && $this->code == null) {
            # code...
            session()->flash('err', 'Form validation faild');
            $this->dispatch('stay-model');
            return;
        }

        $color = new ModelsColor();
        $color->name = $this->name;
        $color->code = $this->code;
        $color->save();
        $this->reset();

        session()->flash('succ', 'Color added successfully');
        $this->dispatch('stay-model');


        // return;
        // $this->reset();
    }

    public function edit($id)
    {
        $color = ModelsColor::find($id);
        if ($color) {
            $this->name = $color->name;
            $this->code = $color->code;
            $this->id = $id;
            $this->dispatch('edit');
        }
    }

    public function update()
    {
        $color = ModelsColor::find($this->id);
        if ($color) {
            $color->name = $this->name;
            $color->code = $this->code;
            $color->save();
            $this->reset();
            session()->flash('succ', 'Updated');
        }
        $this->dispatch('stay-model');
    }

    public function delete($id)
    {
        $color = ModelsColor::find($id);
        if ($color) {
            $this->id = $id;
            $this->dispatch('delete');
            return;
        }
        session()->flash('err', 'Cant find id');
        $this->dispatch('stay-model');
    }

    public function destroy()
    {
        $color = ModelsColor::find($this->id);
        if ($color) {
            $color->delete();
            session()->flash('succ', 'Delete successfully');
        } else {
            session()->flash('err', 'Cant find id');
        }
        $this->dispatch('stay-model');
    }

    public function render()
    {
        $color = ModelsColor::get();
        return view('livewire.backend.color', ['colors' => $color]);
    }
}
