<?php

namespace Tests\Feature\Account;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Helpers\InteractsWithFlashMessages;
use Tests\TestCase;

class SecuritySettingsTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithFlashMessages;

    /** @test */
    public function securitySettingsViewNoAuthentication(): void
    {
        $this->get(route('account.security'))->assertRedirect(route('login'));
    }

    /** @test */
    public function securitySettingsViewWithAuthentication(): void
    {
        $lena = factory(User::class)->create();

        $this->actingAs($lena)->assertAuthenticatedAs($lena)
            ->get(route('account.security'))
            ->assertStatus(200)
            ->assertViewIs('account.settings.security');
    }
}
