<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BCID extends Model
{
    // Explicitly define table name to avoid Laravel's default "b_c_i_d_s"
    protected $table = 'bcids';

    protected $fillable = [
        'user_id',
        'handle',
        'supra_address',
        'base_address',
        'registration_fee_usd',
        'payment_asset',
        'tx_hash',
        'is_active',
        'sequence_number', 
    ];

    /**
     * Protocol Sequence Logic (BCID-1, BCID-2...)
     * Automatically assigns the next integer in the sequence upon creation.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::latest('id')->first();
            $nextNumber = $latest ? $latest->sequence_number + 1 : 1;
            $model->sequence_number = $nextNumber;
        });
    }

    /**
     * Social Graph: Citizens this user has connected with.
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(BCID::class, 'connections', 'citizen_id', 'target_id');
    }

    /**
     * Social Graph: Citizens who have connected with this user.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(BCID::class, 'connections', 'target_id', 'citizen_id');
    }

    /**
     * Protocol Feed: Broadcasts sent by this citizen.
     */
    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'bcid_id');
    }
}