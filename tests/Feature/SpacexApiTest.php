<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpacexApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response_all_data = $this->get('/api/get-all-data');
        $response_all_data->assertStatus(200);

        $response_by_status = $this->get('/api/get-data-by-status/?status=retired');
        $response_by_status->assertStatus(200);

        $response_by_capsule = $this->get('/api/get-data-by-capsule/?capsule=C202');
        $response_by_capsule->assertStatus(200);
    }
}
