<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $table = 'motorcycles';

    protected $primaryKey = 'motorcycle_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'plate_number',
        'brand',
        'model',
        'engine_capacity',
        'year',
    ];
}
