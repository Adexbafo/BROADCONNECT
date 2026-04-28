<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = ['bcid_id', 'broadcast_id', 'type'];

    public function broadcast()
    {
        return $this->belongsTo(Broadcast::class);
    }
}