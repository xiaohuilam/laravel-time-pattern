<?php
namespace Xiaohuilam\LaravelTimePattern;

use Illuminate\Support\ServiceProvider;

class PatterServiceProvider extends ServiceProvider
{
    const CONFIG = __DIR__ . '/config/nlp_time_pattern.php';

    public function register()
    {
        $this->mergeConfig();
        $this->publishConfig();
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(self::CONFIG, 'nlp_time_pattern');
    }

    protected function publishConfig()
    {
        $this->publishableGroups([
            self::CONFIG => config_path('nlp_time_pattern.php'),
        ], 'time-pattern');
    }
}
