<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateSubscriberTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test update subscriber succeeds
     *
     * @return void
     */
    public function test_update_subscriber_succeeds()
    {
        $subscriber = Subscriber::create(['email' => 'john.doe@email.com', 'name' => 'John Doe']);

        $response = $this->put(
            '/api/subscriber/' . $subscriber->id,
            ['email' => 'jane.doe@email.com', 'name' => 'Jane Doe'],
            [
                'Accept' => 'application/json'
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(['email' => 'jane.doe@email.com', 'name' => 'Jane Doe']);
    }

    /**
     * Test update subscriber with fields succeeds
     *
     * @return void
     */
    public function test_update_subscriber_succeeds_with_fields()
    {
        $company = Field::create(['title' => 'company', 'type' => 'string']);
        $jobTitle = Field::create(['title' => 'job_title', 'type' => 'string']);

        $subscriber = Subscriber::create([
            'email' => 'jane.doe@email.com',
            'name' => 'Jane Doe',
            'fields' => [
                'job_title' => 'Full Stack Developer',
                'company' => 'MailerLite'
            ]
        ]);

        $response = $this->put(
            '/api/subscriber/' . $subscriber->id,
            [
                'email' => 'jane.doe@email.com',
                'name' => 'Jane Doe',
                'fields' => ['job_title' => 'Frontend Developer']
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'email' => 'jane.doe@email.com',
                'name' => 'Jane Doe',
                'fields' => [
                    [
                        'id' => $jobTitle->id,
                        'title' => 'job_title',
                        'subscriber_field' => [
                            'value' => 'Frontend Developer'
                        ]
                    ]
                ]
            ]);
    }

    /**
     * Test update subscriber succeeds
     *
     * @return void
     */
    public function test_update_subscriber_fails_if_invalid_state()
    {
        $subscriber = Subscriber::create(['email' => 'john.doe@email.com', 'name' => 'John Doe']);

        $response = $this->put(
            '/api/subscriber/' . $subscriber->id,
            ['email' => 'jane.doe@email.com', 'name' => 'Jane Doe', 'state' => 'invalid_state'],
            [
                'Accept' => 'application/json'
            ]
        );
        $response
            ->assertStatus(422);
    }
}
