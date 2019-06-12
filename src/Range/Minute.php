<?php
namespace Xiaohuilam\LaravelTimePattern\Range;

use Xiaohuilam\LaravelTimePattern\Range\Interfaces\RangeInterface;

class Minute extends AbstractRange implements RangeInterface
{
    public $unit = 60;
}
