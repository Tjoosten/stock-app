<?php

namespace Tests\Feature\Account;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\InteractsWithFlashMessages;
use Tests\TestCase;

class InformationSettingsTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithFlashMessages;

    /** @test */
    public function InformationSettingsViewNoAuthentication(): void
    {
        $this->get(route('account.information'))->assertRedirect(route('login'));
    }

    /** @test */
    public function InformationSettingsViewAuthenticated(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('account.information'))
            ->assertStatus(200)
            ->assertViewIs('account.settings.information');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function InformationSettingsUpdateNoAuth(): void
    {
        $data = ['name' => 'John Doe', 'email' => 'example@domain.tld'];
        $this->patch(route('account.information.update', $data))->assertRedirect(route('login'));
    }

    /** @test */
    public function InformationSettingsUpdateAuthenticated(): void
    {
        $user = factory(User::class)->create();
        $data = ['name' => 'John Doe', 'email' => 'example@domain.tld'];

        $request = $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $request->patch(route('account.information.update'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('account.information'));

        $this->assertCount(1, $this->flashMessagesForLevel('success'));
        $this->assertDatabaseHas('users', $data);
    }

    /** @test */
    public function InformationSettingsUpdateValidationErrors(): void
    {
        $user = factory(User::class)->create();

        $request = $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $request->patch(route('account.information.update'), [])
            ->assertSessionHasErrors(['name', 'email'])
            ->assertStatus(302);

    }
}
