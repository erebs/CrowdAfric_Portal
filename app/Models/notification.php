<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
     protected $table='notifications';
    protected $guarded=[];

        protected $hidden = [
        'created_at',
        'updated_at',
        'noti_type',

    ];


     public function GetUser()
    {
        return $this->belongsTo(User::class, 'noti_type', 'id');
    }

    public function GetCamp()
    {
        return $this->belongsTo(campaign::class, 'campaign', 'id');
    }
}
