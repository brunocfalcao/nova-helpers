<?php

namespace Brunocfalcao\NovaHelpers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

final class NovaHelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacros();
    }

    public function register()
    {
    }

    private function registerMacros()
    {
        // Include all files from the Macros folder.
        Collection::make(glob(__DIR__.'/Macros/*.php'))
                  ->mapWithKeys(function ($path) {
                      return [$path => pathinfo($path, PATHINFO_FILENAME)];
                  })
                  ->each(function ($macro, $path) {
                      require_once $path;
                  });
    }
}
