<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
=======
use Illuminate\Foundation\Testing\RefreshDatabase;
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function confirmPasswordScreenCanBeRendered(): void
=======
    public function confirm_password_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
=======
    public function test_confirm_password_screen_can_be_rendered(): void
>>>>>>> d9f7748 (up)
    {
        $user = User::factory()->withPersonalTeam()->create();

        $response = $this->actingAs($user)->get('/user/confirm-password');

        $response->assertStatus(200);
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordCanBeConfirmed(): void
=======
    public function password_can_be_confirmed(): void
>>>>>>> cf6505a (.)
=======
    public function test_password_can_be_confirmed(): void
>>>>>>> d9f7748 (up)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordIsNotConfirmedWithInvalidPassword(): void
=======
    public function password_is_not_confirmed_with_invalid_password(): void
>>>>>>> cf6505a (.)
=======
    public function test_password_is_not_confirmed_with_invalid_password(): void
>>>>>>> d9f7748 (up)
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
