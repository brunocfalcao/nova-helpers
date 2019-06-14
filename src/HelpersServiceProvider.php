<?php

namespace Brunocfalcao\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class HelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacros();
        $this->bootBladeDirectives();
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

    protected function bootBladeDirectives()
    {
        Blade::if('action', function ($action) {
            if (Route::getCurrentRoute()->getActionMethod() == $action) {
                return $action;
            }
        });

        Blade::directive(
            'fa',
            function ($expression) {
                return "<?php echo (new \\Brunocfalcao\\Helpers\\BladeDirectives\\Fa($expression))->render() ?>";
            }
        );

        Blade::if('env', function ($env) {
            return app()->environment($env);
        });

        Blade::directive('pushonce', function ($expression) {
            $var = '$__env->{"__pushonce_" . md5(__FILE__ . ":" . __LINE__)}';

            return "<?php if(!isset({$var})): {$var} = true; \$__env->startPush({$expression}); ?>";
        });

        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });
    }

    public function register()
    {
    }
}
