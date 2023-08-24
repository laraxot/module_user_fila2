<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire;

<<<<<<< HEAD
<<<<<<< HEAD
use ArtMin96\FilamentJet\FilamentJet;
=======
<<<<<<< HEAD
=======
=======
>>>>>>> 50d5b27 (up)
use ArtMin96\FilamentJet\FilamentJet;
use Illuminate\Support\Str;
use Livewire\Component;
<<<<<<< HEAD
>>>>>>> 36aaec9 (.)
use Illuminate\Support\Str;
use Livewire\Component;

use function Safe\file_get_contents;

use Webmozart\Assert\Assert;
=======
use Webmozart\Assert\Assert;

<<<<<<< HEAD
>>>>>>> 50d5b27 (up)
=======
use function Safe\file_get_contents;
>>>>>>> cf6505a (.)

class PrivacyPolicy extends Component
{
    /**
     * Show the terms of service for the application.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        Assert::string($policyFile = FilamentJet::localizedMarkdownPath('policy.md'), 'wip');

        $view = view('filament-jet::livewire.privacy-policy', [
            'terms' => Str::markdown(file_get_contents($policyFile)),
        ]);

        $view->layout('filament::components.layouts.base', [
            'title' => __('filament-jet::registration.privacy_policy'),
        ]);

        return $view;
    }
}
