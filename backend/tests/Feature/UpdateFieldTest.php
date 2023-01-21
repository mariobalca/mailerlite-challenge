<?php

namespace Tests\Feature;

use App\Models\Field;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateFieldTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test update field succeeds
     *
     * @return void
     */
    public function test_update_field_succeeds()
    {
        $field = Field::create(['title' => 'company', 'type' => 'string']);

        $response = $this->put(
            '/api/field/' . $field->id,
            ['title' => 'job_title', 'type' => 'string'],
            [
                'Accept' => 'application/json'
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['title' => 'job_title', 'type' => 'string']);

        $this->assertDatabaseCount('fields', 1);
    }

    /**
     * Test update field fails when title is not unique
     *
     * @return void
     */
    public function test_update_field_fails_if_duplicate_title()
    {
        Field::create(['title' => 'job_title', 'type' => 'string']);
        $fieldCompany = Field::create(['title' => 'company', 'type' => 'string']);

        $response = $this->put(
            '/api/field/' . $fieldCompany->id,
            ['title' => 'job_title'],
            [
                'Accept' => 'application/json'
            ]
        );
        $response->assertStatus(422);
    }

    /**
     * Test update field fails when type is invalid
     *
     * @return void
     */
    public function test_update_field_fails_if_invalid_type()
    {
        $field = Field::create(['title' => 'state', 'type' => 'string']);

        $response = $this->put(
            '/api/field/' . $field->id,
            ['title' => 'state', 'type' => 'enum'],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(422);
    }
}
