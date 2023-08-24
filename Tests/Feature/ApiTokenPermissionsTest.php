<?php
/**
 * @see https://github.com/nWidart/laravel-modules/blob/master/tests/BaseTestCase.php
 */

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
<<<<<<< HEAD
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;

// use Nwidart\Modules\Tests\BaseTestCase;
// use Orchestra\Testbench\TestCase as OrchestraTestCase;
=======
=======
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function apiTokenPermissionsCanBeUpdated(): void
=======
    public function api_token_permissions_can_be_updated(): void
>>>>>>> cf6505a (.)
=======
    public function test_api_token_permissions_can_be_updated(): void
>>>>>>> d9f7748 (up)
    {
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');

            return;
        }

        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        Livewire::test(ApiTokenManager::class)
            ->set(['managingPermissionsFor' => $token])
            ->set(['updateApiTokenForm' => [
                'permissions' => [
                    'delete',
                    'missing-permission',
                ],
            ]])
            ->call('updateApiToken');

        $this->assertTrue($user->fresh()->tokens->first()->can('delete'));
        $this->assertFalse($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}
