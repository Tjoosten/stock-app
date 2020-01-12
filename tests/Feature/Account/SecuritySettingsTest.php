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

    /** @test */
    public function updateSecuritySettingsCurrentPasswordCheckFails(): void
    {
        $taylor = factory(User::class)->create();
        $data = ['current_password' => 'faultyPassword', 'password' => 'password', 'password_confirmation' => 'password'];

        $this->actingAs($taylor)
            ->assertAuthenticatedAs($taylor)
            ->patch(route('account.security.update', $data))
            ->assertSessionHasErrorsIn('default', 'current_password');

        $this->assertEquals(session('errors')->get('current_password')[0] , __('validation.matchUserPassword'));
    }

    /** @test */
    public function updateSecuritySettingsConfirmationCheckFails(): void
    {

    }
     /** @test */
    public function updateSecuritySettingsWhenNoAuthentication(): void
    {

    }

    /** @test */
    public function updateSecuritySettingsSuccess(): void
    {

    }

    /** @test */
    public function updateSucritySettingsValidationErrors(): void
    {

    }
}
