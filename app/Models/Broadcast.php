<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broadcast extends Model
{
    protected $fillable = ['bcid_id', 'content'];

    public function bcid(): BelongsTo
    {
        return $this->belongsTo(BCID::class, 'bcid_id');
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    public function likes(): HasMany
    {
        return $this->interactions()->where('type', 'like');
    }
}