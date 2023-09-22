<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campaign_category extends Model
{
    use HasFactory;
     protected $table='campaign_categories';
    protected $guarded=[];

      protected $hidden = [
        'created_at',
        'updated_at',

    ];
}
