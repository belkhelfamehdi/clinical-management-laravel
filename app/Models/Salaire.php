<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    protected $table = 'salaire';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id', 'salaire'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id');
    }
}
