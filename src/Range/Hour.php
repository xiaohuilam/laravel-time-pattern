<?php
namespace Xiaohuilam\LaravelTimePattern\Range;

use Xiaohuilam\LaravelTimePattern\Range\Interfaces\RangeInterface;

class Hour extends AbstractRange implements RangeInterface
{
    public $unit = 60 * 60;
}
