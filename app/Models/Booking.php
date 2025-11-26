<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = ['start_date', 'end_date', 'amount', 'status', 'renter_id'];
    public function rent(): BelongsTo {
        return $this->belongsTo(Rent::class);
            }
            public function renter(): BelongsTo {
                return $this->belongsTo(User::class, 'renter_id');
                    }
}
