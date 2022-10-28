<?php

namespace Tests\Feature\Private;

use App\Models\Participant;
use App\Models\SecretList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipantsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_add_participants_to_a_list()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
