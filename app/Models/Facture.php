<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'facture';
    public $timestamps = false;
    protected $primaryKey = 'num';
    public $incrementing = true;
    protected $fillable = ['num', 'Montant', 'id_p'];
}
