<?php
namespace Xiaohuilam\LaravelTimePattern\Traits;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

trait HasCarbon
{
    public static function carbon()
    {
        return new Carbon();
    }
}
