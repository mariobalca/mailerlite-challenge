<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create(['title' => 'company', 'type' => 'string']);
        Field::create(['title' => 'job_title', 'type' => 'string']);
        Field::create(['title' => 'age', 'type' => 'number']);
        Field::create(['title' => 'subscribed_at', 'type' => 'date']);
        Field::create(['title' => 'private', 'type' => 'boolean']);
    }
}
