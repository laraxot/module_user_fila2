<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function loginScreenCanBeRendered(): void
=======
    public function login_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function usersCanAuthenticateUsingTheLoginScreen(): void
=======
    public function users_can_authenticate_using_the_login_screen(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function usersCanNotAuthenticateWithInvalidPassword(): void
=======
    public function users_can_not_authenticate_with_invalid_password(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
