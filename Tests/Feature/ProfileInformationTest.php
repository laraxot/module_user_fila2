<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function currentProfileInformationIsAvailable(): void
=======
    public function current_profile_information_is_available(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->name, $component->state['name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function profileInformationCanBeUpdated(): void
=======
    public function profile_information_can_be_updated(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
