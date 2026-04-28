<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    protected $table = 'chambre';
    public $timestamps = false;
    protected $primaryKey = 'num';
    public $incrementing = true;
    protected $fillable = ['num', 'id_p', 'id_e'];
}
