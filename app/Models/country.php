<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
     protected $table='countries';
    protected $guarded=[];


        protected $hidden = [
        'status',
        'created_at',
        'updated_at',

    ];
}
