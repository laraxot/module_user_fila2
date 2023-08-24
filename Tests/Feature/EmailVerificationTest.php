<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;
<<<<<<< HEAD
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
=======
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function emailVerificationScreenCanBeRendered(): void
=======
    public function email_verification_screen_can_be_rendered(): void
>>>>>>> cf6505a (.)
=======
    public function test_email_verification_screen_can_be_rendered(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');

            return;
        }

        $user = User::factory()->withPersonalTeam()->unverified()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertStatus(200);
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function emailCanBeVerified(): void
=======
    public function email_can_be_verified(): void
>>>>>>> cf6505a (.)
=======
    public function test_email_can_be_verified(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');

            return;
        }

        Event::fake();

        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function emailCanNotVerifiedWithInvalidHash(): void
=======
    public function email_can_not_verified_with_invalid_hash(): void
>>>>>>> cf6505a (.)
=======
    public function test_email_can_not_verified_with_invalid_hash(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');

            return;
        }

        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
