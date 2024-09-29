<?php

namespace App\Livewire\Backend;

use App\Models\Size as ModelsSize;
use Livewire\Component;

class Size extends Component
{
    public $id      = null;
    public $name    = null;


    public function save()
    {
        if ($this->name == null && $this->code == null) {
            # code...
            session()->flash('err', 'Form validation faild');
            $this->dispatch('stay-model');
            return;
        }

        $color = new ModelsSize();
        $color->name = $this->name;
        $color->save();
        $this->reset();

        session()->flash('succ', 'Color added successfully');
        $this->dispatch('stay-model');
    }

    public function edit($id)
    {
        $color = ModelsSize::find($id);
        if ($color) {
            $this->name = $color->name;
            $this->id = $id;
            $this->dispatch('sizeEdit');
        }
    }

    public function update()
    {
        $color = ModelsSize::find($this->id);
        if ($color) {
            $color->name = $this->name;
            $color->save();
            $this->reset();
            session()->flash('succ', 'Updated');
        }
        $this->dispatch('stay-model');
    }

    public function delete($id)
    {
        $color = ModelsSize::find($id);
        if ($color) {
            $this->id = $id;
            $this->dispatch('sizeDelete');
            return;
        }
        session()->flash('err', 'Cant find id');
        $this->dispatch('stay-model');
    }

    public function destroy()
    {
        $color = ModelsSize::find($this->id);
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
        $size = ModelsSize::all();
        return view('livewire.backend.size', ['sizes' => $size]);
    }
}
