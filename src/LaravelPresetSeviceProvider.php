<?php

namespace Acme\LaravelPreset;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class LaravelPresetSerivceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('tailwind', function ($command) {
            LaravelPreset::install();
            $command->info('all worked');
        });
    }

   
}
