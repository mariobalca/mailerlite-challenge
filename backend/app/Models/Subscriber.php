<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'email',
        'name',
        'state',
    ];

    public function fields() {
        return $this->hasMany(SubscriberFieldValue::class);
    }
}
