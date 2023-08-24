<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Modules\User\Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function registrationScreenCanBeRendered(): void
=======
    public function registration_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');

            return;
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function registrationScreenCannotBeRenderedIfSupportIsDisabled(): void
=======
    public function registration_screen_cannot_be_rendered_if_support_is_disabled(): void
>>>>>>> cf6505a (.)
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');

            return;
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function newUsersCanRegister(): void
=======
    public function new_users_can_register(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');

            return;
        }

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
