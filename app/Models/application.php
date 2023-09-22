<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;
     protected $table='applications';
    protected $guarded=[];

    public function GetUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function GetCon()
    {
        return $this->belongsTo(country::class, 'country_id', 'id');
    }
    public function GetArea()
    {
        return $this->belongsTo(local_gov_area::class, 'local_area', 'id');
    }

    public function GetState()
    {
        return $this->belongsTo(state::class, 'state_id', 'id');
    }

    public function GetCamp()
    {
        return $this->belongsTo(campaign::class, 'campaign_id', 'id');
    }
     public function GetAdmin()
    {
        return $this->belongsTo(admin_detail::class, 'blocked_by', 'id');
    }
}
