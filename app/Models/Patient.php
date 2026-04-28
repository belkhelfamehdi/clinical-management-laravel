<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    public $timestamps = false;
    protected $fillable = ['nom', 'prenom', 'daten', 'gen', 'num', 'email', 'addr', 'gs'];
}
