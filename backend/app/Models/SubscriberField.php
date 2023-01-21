<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubscriberField extends Pivot
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'value',
    ];
}
