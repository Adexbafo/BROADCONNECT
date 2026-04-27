<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Broadcast extends Model
{
    protected $fillable = ['bcid_id', 'content'];

    public function bcid(): BelongsTo
    {
        return $this->belongsTo(BCID::class, 'bcid_id');
    }
}