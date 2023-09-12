<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Modules\User\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function registrationScreenCanBeRendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');

            return;
        }

        $testResponse = $this->get('/register');

        $testResponse->assertStatus(200);
    }

    #[Test]
    public function registrationScreenCannotBeRenderedIfSupportIsDisabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');

            return;
        }

        $testResponse = $this->get('/register');

        $testResponse->assertStatus(404);
    }

    #[Test]
    public function newUsersCanRegister(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');

            return;
        }

        $testResponse = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $testResponse->assertRedirect(RouteServiceProvider::HOME);
    }
}
