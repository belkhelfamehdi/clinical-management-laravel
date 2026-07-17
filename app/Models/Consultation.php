<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultation';
    protected $primaryKey = 'num';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['date', 'id_p', 'id_e'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_p');
    }

    public function doctor()
    {
        return $this->belongsTo(Employee::class, 'id_e');
    }
}
