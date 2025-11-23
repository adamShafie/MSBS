<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    protected $table = 'booking_approvals';

    protected $fillable = [
        'approval_id',
        'booking_id',
        'user_id',
        'decision',
        'proposed_date',
        'quoted_price',
        'approved_at',
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
