<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repayment extends Model
{
    use HasFactory;

    protected $table='repayments';
    protected $guarded=[];

     public function GetUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function GetApp()
    {
        return $this->belongsTo(application::class, 'application_id', 'id');
    }

    
}
