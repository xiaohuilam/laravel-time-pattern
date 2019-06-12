<?php
namespace Xiaohuilam\LaravelTimePattern;

use Illuminate\Support\ServiceProvider;

class PatterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfig();
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/nlp_time_pattern.php', 'nlp_time_pattern');
    }
}
