<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $table = 'ordonnance';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['date_ord', 'id_em'];
}
