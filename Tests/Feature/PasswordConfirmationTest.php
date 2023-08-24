<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function confirmPasswordScreenCanBeRendered(): void
=======
    public function confirm_password_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->withPersonalTeam()->create();

        $response = $this->actingAs($user)->get('/user/confirm-password');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordCanBeConfirmed(): void
=======
    public function password_can_be_confirmed(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordIsNotConfirmedWithInvalidPassword(): void
=======
    public function password_is_not_confirmed_with_invalid_password(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
