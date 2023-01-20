<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberFieldValue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'value',
    ];

    public function field() {
        $this->belongsTo(Field::class);
    }

    public function subscriber() {
        $this->belongsTo(Subscriber::class);
    }
}
