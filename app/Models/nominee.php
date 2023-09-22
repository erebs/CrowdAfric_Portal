<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nominee extends Model
{
    use HasFactory;
    protected $table='nominees';
    protected $guarded=[];

        protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',

    ];
}
