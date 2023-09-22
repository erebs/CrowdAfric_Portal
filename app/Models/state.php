<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
     protected $table='states';
    protected $guarded=[];

    public function GetCon()
    {
        return $this->belongsTo(country::class, 'country_id', 'id');
    }

     protected $hidden = [
        'status',
        'country_id',
        'created_at',
        'updated_at',

    ];
}
