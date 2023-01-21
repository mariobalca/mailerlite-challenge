<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StoreFieldTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test store field succeeds
     *
     * @return void
     */
    public function test_store_field_succeeds()
    {
        $field = ['title' => 'company', 'type' => 'string'];

        $response = $this->post(
            '/api/field',
            $field,
            [
                'Accept' => 'application/json'
            ]
        );
        $response
            ->assertStatus(201)
            ->assertJson(['title' => 'company', 'type' => 'string']);

        $this->assertDatabaseCount('fields', 1);
    }

    /**
     * Test store field fails when title is not unique
     *
     * @return void
     */
    public function test_store_field_fails_if_duplicate_title()
    {
        $field = ['title' => 'company', 'type' => 'string'];

        $responseSuccess = $this->post(
            '/api/field',
            $field,
            [
                'Accept' => 'application/json'
            ]
        );
        $responseFail = $this->post(
            '/api/field',
            $field,
            [
                'Accept' => 'application/json'
            ]
        );

        $responseSuccess->assertStatus(201);
        $responseFail->assertStatus(422);

        $this->assertDatabaseCount('fields', 1);
    }

    /**
     * Test store field fails when type is invalid
     *
     * @return void
     */
    public function test_store_field_fails_if_invalid_type()
    {
        $field = ['title' => 'state', 'type' => 'enum'];

        $response = $this->post(
            '/api/field',
            $field,
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(422);

        $this->assertDatabaseCount('fields', 0);
    }
}
