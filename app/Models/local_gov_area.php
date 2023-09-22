<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local_gov_area extends Model
{
    use HasFactory;
    protected $table='local_gov_areas';
    protected $guarded=[];
    public $timestamps = false;

     public function GetSt()
    {
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
}
