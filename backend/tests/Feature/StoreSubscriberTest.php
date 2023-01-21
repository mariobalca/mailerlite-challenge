<?php

namespace Tests\Feature;

use App\Models\Field;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StoreSubscriberTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test store subscriber succeeds
     *
     * @return void
     */
    public function test_store_subscriber_succeeds()
    {
        $subscriber = ['email' => 'john.doe@email.com', 'name' => 'John Doe'];

        $response = $this->post(
            '/api/subscriber',
            $subscriber,
            [
                'Accept' => 'application/json'
            ]
        );
        $response
            ->assertStatus(201)
            ->assertJson(['email' => 'john.doe@email.com', 'name' => 'John Doe']);

        $this->assertDatabaseCount('subscribers', 1);
    }

    /**
     * Test store subscriber with fields succeeds
     *
     * @return void
     */
    public function test_store_subscriber_succeeds_with_fields()
    {
        $company = Field::create(['title' => 'company', 'type' => 'string']);
        $jobTitle = Field::create(['title' => 'job_title', 'type' => 'string']);

        $subscriber = [
            'email' => 'john.doe@email.com',
            'name' => 'John Doe',
            'fields' => [
                'job_title' => 'Full Stack Developer',
                'company' => 'MailerLite'
            ]
        ];

        $response = $this->post(
            '/api/subscriber',
            $subscriber,
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'email' => 'john.doe@email.com',
                'name' => 'John Doe',
                'fields' => [
                    [
                        'id' => $jobTitle->id,
                        'title' => 'job_title',
                        'subscriber_field' => [
                            'value' => 'Full Stack Developer'
                        ]
                    ],
                    [
                        'id' => $company->id,
                        'title' => 'company',
                        'subscriber_field' => [
                            'value' => 'MailerLite'
                        ]
                    ],
                ]
            ]);

        $this->assertDatabaseCount('subscribers', 1);
    }

    /**
     * Test store subscriber fails when title is not unique
     *
     * @return void
     */
    public function test_store_subscriber_fails_if_duplicate_email()
    {
        $subscriber = ['email' => 'john.doe@email.com', 'name' => 'John Doe'];

        $responseSuccess = $this->post(
            '/api/subscriber',
            $subscriber,
            [
                'Accept' => 'application/json'
            ]
        );
        $responseFail = $this->post(
            '/api/subscriber',
            $subscriber,
            [
                'Accept' => 'application/json'
            ]
        );

        $responseSuccess->assertStatus(201);
        $responseFail->assertStatus(422);

        $this->assertDatabaseCount('subscribers', 1);
    }

    /**
     * Test store subscriber with fields that don't exist fails
     *
     * @return void
     */
    public function test_store_subscriber_fails_if_fields_that_dont_exist()
    {
        $company = Field::create(['title' => 'company', 'type' => 'string']);

        $subscriber = [
            'email' => 'john.doe@email.com',
            'name' => 'John Doe',
            'fields' => [
                'job_title' => 'Full Stack Developer',
                'company' => 'MailerLite'
            ]
        ];

        $response = $this->post(
            '/api/subscriber',
            $subscriber,
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertStatus(422);

        $this->assertDatabaseCount('subscribers', 0);
    }
}
