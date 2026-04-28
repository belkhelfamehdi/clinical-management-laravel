<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donneur extends Model
{
    protected $table = 'donneur';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nom', 'prenom', 'numero', 'gs'];
}
