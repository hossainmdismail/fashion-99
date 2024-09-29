<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function sizes()
    {
        return Size::whereIn('id', function ($query) {
            $query->select('size_id')
                ->from('inventories')
                ->where('color_id', $this->id)
                ->groupBy('size_id');
        })->get();
    }
}
