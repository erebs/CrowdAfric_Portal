<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lucky_draw_item extends Model
{
    use HasFactory;
         protected $table='lucky_draw_items';
    protected $guarded=[];

    public function GetCon()
    {
        return $this->belongsTo(country::class, 'country', 'id');
    }

    public function GetState()
    {
        return $this->belongsTo(state::class, 'state', 'id');
    }
}
