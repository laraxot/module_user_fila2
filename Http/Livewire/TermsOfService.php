<?php

namespace Modules\User\Http\Livewire;

use Modules\User\FilamentJet;
use Illuminate\Support\Str;
use Livewire\Component;

class TermsOfService extends Component
{
    /**
     * Show the terms of service for the application.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $termsFile = FilamentJet::localizedMarkdownPath('terms.md');

        $view = view('filament-jet::livewire.terms-of-service', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);

        $view->layout('filament::components.layouts.base', [
            'title' => __('filament-jet::registration.terms_of_service'),
        ]);

        return $view;
    }
}
