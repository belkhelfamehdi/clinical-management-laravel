<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cong extends Model
{
    protected $table = 'cong';
    protected $primaryKey = 'num_cn';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['num_cn', 'id_em', 'dated', 'datef'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_em');
    }
}
