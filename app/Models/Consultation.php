<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultation';
    protected $primaryKey = 'num';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['num', 'date', 'id_p'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_p');
    }

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'id_e');
    }
}
