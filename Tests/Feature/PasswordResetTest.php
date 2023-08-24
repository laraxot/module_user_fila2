<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function resetPasswordLinkScreenCanBeRendered(): void
=======
    public function reset_password_link_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');

            return;
        }

        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function resetPasswordLinkCanBeRequested(): void
=======
    public function reset_password_link_can_be_requested(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');

            return;
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function resetPasswordScreenCanBeRendered(): void
=======
    public function reset_password_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');

            return;
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) {
            $response = $this->get('/reset-password/' . $notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordCanBeResetWithValidToken(): void
=======
    public function password_can_be_reset_with_valid_token(): void
>>>>>>> cf6505a (.)
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');

            return;
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
