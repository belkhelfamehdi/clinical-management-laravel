<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
    public $timestamps = false;
    protected $primaryKey = 'gs';
    public $incrementing = false;
    protected $fillable = ['gs', 'quantite'];
}
