<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conge extends Model
{
    protected $table = 'cong';
    public $timestamps = false;
    protected $primaryKey = 'num_cn';
    public $incrementing = true;
    protected $fillable = ['id_em', 'dated', 'datef'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'id_em');
    }
}
