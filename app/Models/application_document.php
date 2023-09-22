<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application_document extends Model
{
    use HasFactory;
    protected $table='application_documents';
    protected $guarded=[];
}
