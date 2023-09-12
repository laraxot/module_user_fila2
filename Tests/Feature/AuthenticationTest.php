<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\User;
use Modules\User\Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function loginScreenCanBeRendered(): void
    {
        $testResponse = $this->get('/login');

        $testResponse->assertStatus(200);
    }

    #[Test]
    public function usersCanAuthenticateUsingTheLoginScreen(): void
    {
        $user = User::factory()->create();

        $testResponse = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $testResponse->assertRedirect(RouteServiceProvider::HOME);
    }

    #[Test]
    public function usersCanNotAuthenticateWithInvalidPassword(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
