<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    use HasFactory;
    protected $table='campaigns';
    protected $guarded=[];

     public function GetCat()
    {
        return $this->belongsTo(campaign_category::class, 'cat_id', 'id');
    }

    protected $hidden = [
        'cat_id',
        'created_at',
        'updated_at',

    ];
}
