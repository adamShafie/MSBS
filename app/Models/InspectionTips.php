<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionTips extends Model
{
    protected $table = 'inspection_tips';

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
    ];
}
