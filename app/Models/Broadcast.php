<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broadcast extends Model
{
    protected $fillable = ['bcid_id', 'content', 'parent_id'];

    public function bcid(): BelongsTo
    {
        return $this->belongsTo(BCID::class, 'bcid_id');
    }

    // This is the one that was missing!
    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    // Helper for likes
    public function likes(): HasMany
    {
        return $this->interactions()->where('type', 'like');
    }

    // Replies to this broadcast
    public function replies(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'parent_id');
    }

    // The original post (if this is a reply)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Broadcast::class, 'parent_id');
    }
}