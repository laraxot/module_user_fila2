<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function passwordCanBeUpdated(): void
=======
    public function password_can_be_updated(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('updatePassword');

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function currentPasswordMustBeCorrect(): void
=======
    public function current_password_must_be_correct(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function newPasswordsMustMatch(): void
=======
    public function new_passwords_must_match(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'wrong-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['password']);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
