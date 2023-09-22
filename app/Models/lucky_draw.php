<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lucky_draw extends Model
{
    use HasFactory;
    protected $table='lucky_draws';
    protected $guarded=[];

     public function GetUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function GetCamp()
    {
        return $this->belongsTo(campaign::class, 'campaign_id', 'id');
    }

    public function GetLucky()
    {
        return $this->belongsTo(lucky_draw_item::class, 'lucky_id', 'id');
    }
}
