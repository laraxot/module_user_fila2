<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire;

<<<<<<< HEAD
<<<<<<< HEAD
use ArtMin96\FilamentJet\FilamentJet;
=======
<<<<<<< HEAD
=======
use ArtMin96\FilamentJet\FilamentJet;
use Illuminate\Support\Str;
>>>>>>> 1903df6 (up)
=======
>>>>>>> 50d5b27 (up)
use Livewire\Component;
>>>>>>> 36aaec9 (.)
use Illuminate\Support\Str;
use Livewire\Component;

use function Safe\file_get_contents;

use Webmozart\Assert\Assert;

class TermsOfService extends Component
{
    /**
     * Show the terms of service for the application.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        Assert::string($termsFile = FilamentJet::localizedMarkdownPath('terms.md'), 'wip');

        $view = view('filament-jet::livewire.terms-of-service', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);

        $view->layout('filament::components.layouts.base', [
            'title' => __('filament-jet::registration.terms_of_service'),
        ]);

        return $view;
    }
}
