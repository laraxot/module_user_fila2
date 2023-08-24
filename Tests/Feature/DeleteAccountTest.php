<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;
<<<<<<< HEAD
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
=======
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function userAccountsCanBeDeleted(): void
=======
    public function user_accounts_can_be_deleted(): void
>>>>>>> cf6505a (.)
=======
    public function test_user_accounts_can_be_deleted(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');

            return;
        }

        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(DeleteUserForm::class)
            ->set('password', 'password')
            ->call('deleteUser');

        $this->assertNull($user->fresh());
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function correctPasswordMustBeProvidedBeforeAccountCanBeDeleted(): void
=======
    public function correct_password_must_be_provided_before_account_can_be_deleted(): void
>>>>>>> cf6505a (.)
=======
    public function test_correct_password_must_be_provided_before_account_can_be_deleted(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');

            return;
        }

        $this->actingAs($user = User::factory()->create());

        Livewire::test(DeleteUserForm::class)
            ->set('password', 'wrong-password')
            ->call('deleteUser')
            ->assertHasErrors(['password']);

        $this->assertNotNull($user->fresh());
    }
}
