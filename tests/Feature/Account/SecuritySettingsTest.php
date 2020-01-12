<?php

namespace Tests\Feature\Account;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
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

        $this->assertEquals(session('errors')->get('current_password')[0], __('validation.matchUserPassword'));
    }

    /** @test */
    public function updateSecuritySettingsConfirmationCheckFails(): void
    {
        $taylor = factory(User::class)->create();
        $data = ['current_password' => $taylor->password, 'password' => 'password', 'password_confirmation' => 'faultyPassword'];

        $this->actingAs($taylor)
            ->assertAuthenticatedAs($taylor)
            ->patch(route('account.security.update', $data))
            ->assertSessionHasErrorsIn('default', 'password');

        $this->assertEquals(session('errors')->get('password')[0], __('validation.confirmed', ['attribute' => 'password']));
    }
     /** @test */
    public function updateSecuritySettingsWhenNoAuthentication(): void
    {
        $data = ['current_password' => 'current_password', 'password' => 'password', 'password_confirmation' => 'password'];

        $this->patch(route('account.security.update', $data))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function updateSecuritySettingsSuccess(): void
    {
        $lena = factory(User::class)->create();
        $data = ['current_password' => 'password', 'password' => 'rootroot', 'password_confirmation' => 'rootroot'];

        $this->actingAs($lena)
            ->assertAuthenticatedAs($lena)
            ->patch(route('account.security.update', $data))
            ->assertRedirect(route('account.security'));

        $this->assertTrue(Hash::check($data['password'], auth()->user()->getAuthPassword()));
        $this->flashMessagesForLevel('success');
    }

    /** @test */
    public function updateSucritySettingsValidationErrors(): void
    {
        $taylor = factory(User::class)->create();

        $this->actingAs($taylor)
            ->assertAuthenticatedAs($taylor)
            ->patch(route('account.security.update', []))
            ->assertSessionHasErrors(['current_password', 'password'])
            ->assertStatus(302);
    }
}
