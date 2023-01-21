<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SyncFieldsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test number of subscriber_field records created when no fields/values are passed.
     *
     * @return void
     */
    public function test_sync_fields_empty()
    {
        $subscriber = Subscriber::factory()->make();

        $this->assertEquals(0, $subscriber->fields()->count());
    }

    /**
     * Test number of subscriber_field records created when two fields/values are passed.
     *
     * @return void
     */
    public function test_sync_fields_with_two_values()
    {
        $subscriber = Subscriber::factory()->create();
        Field::create(['title' => 'company', 'type' => 'string']);
        Field::create(['title' => 'job_title', 'type' => 'string']);

        $subscriber->syncFields([
            'company' => fake()->company(),
            'job_title' => fake()->jobTitle()
        ]);

        $this->assertEquals(2, $subscriber->fields()->count());
    }

    /**
     * Test number of subscriber_field records when five fields/values are passed.
     *
     * @return void
     */
    public function test_sync_fields_with_five_values()
    {
        $subscriber = Subscriber::factory()->create();
        Field::create(['title' => 'company', 'type' => 'string']);
        Field::create(['title' => 'job_title', 'type' => 'string']);
        Field::create(['title' => 'phone_number', 'type' => 'string']);
        Field::create(['title' => 'joined_at', 'type' => 'date']);
        Field::create(['title' => 'visible', 'type' => 'boolean']);


        $subscriber->syncFields([
            'company' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'phone_number' => fake()->phoneNumber(),
            'joined_at' => fake()->dateTime(),
            'visible' => fake()->boolean()
        ]);

        $this->assertEquals(5, $subscriber->fields()->count());
    }
}
