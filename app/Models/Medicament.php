<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = 'medicament';
    public $timestamps = false;
    protected $primaryKey = 'numM';
    public $incrementing = true;
    protected $fillable = ['numM', 'nom', 'quantite'];
}
