<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'type',
    ];

    public function values() {
        return $this->hasMany(SubscriberFieldValue::class);
    }
}
