<?php
namespace Xiaohuilam\LaravelTimePattern\Range;

use Xiaohuilam\LaravelTimePattern\Range\Interfaces\RangeInterface;

class Season extends AbstractRange implements RangeInterface
{
    public $unit = 60 * 60 * 24 * 91;
}
