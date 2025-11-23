<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'motorcycle_id',
        'service_type',
        'preferred_date',
        'remarks',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, 'motorcycle_id');
    }
    public function bookingApproval()
    {
        return $this->hasOne(BookingApproval::class, 'booking_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
