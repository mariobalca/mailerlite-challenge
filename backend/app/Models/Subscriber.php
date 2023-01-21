<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory, HasUuids;

    protected $with = ['fields'];

    protected $fillable = [
        'email',
        'name',
        'state',
    ];

    public function fields() {
        return $this
            ->belongsToMany(Field::class, 'subscriber_field')
            ->using(SubscriberField::class)
            ->as('subscriber_field')
            ->withPivot(['value'])
            ->withTimestamps();
    }

    public function syncFields($fields) {
        foreach($fields as $attribute => $value) {
            $field = Field::where('title', $attribute)->first();
            $this->fields()->syncWithPivotValues($field->id, ['value' => $value]);
        }
    }
}
