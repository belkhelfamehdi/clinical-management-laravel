<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employe';
    public $timestamps = false;
    protected $fillable = ['nom', 'prenom', 'daten', 'dateem', 'gen', 'num', 'email', 'fonction'];
}
