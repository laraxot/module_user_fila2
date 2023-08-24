<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm;
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

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function otherBrowserSessionsCanBeLoggedOut(): void
=======
    public function other_browser_sessions_can_be_logged_out(): void
>>>>>>> cf6505a (.)
=======
    public function test_other_browser_sessions_can_be_logged_out(): void
>>>>>>> d9f7748 (up)
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(LogoutOtherBrowserSessionsForm::class)
            ->set('password', 'password')
            ->call('logoutOtherBrowserSessions')
            ->assertSuccessful();
    }
}
