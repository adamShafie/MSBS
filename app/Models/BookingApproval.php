<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    protected $table = 'booking_approvals';

    // If your table uses booking_id as the primary key:
    protected $primaryKey = 'booking_id';
    public $incrementing = false; // set true only if booking_id is auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'booking_id',
        'user_id',
        'decision',
        'quoted_price',
        'approved_at',
        'rejection_reason',
    ];
}
