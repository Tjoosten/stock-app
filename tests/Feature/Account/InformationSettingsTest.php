<?php

namespace Tests\Feature\Account;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InformationSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function InformationSettingsViewNoAuthentication(): void
    {
        $this->get(route('account.information'))->assertRedirect(route('login'));
    }

    /** @test */
    public function INformationSettingsViewAuthenticated(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('account.information'))->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }
}
