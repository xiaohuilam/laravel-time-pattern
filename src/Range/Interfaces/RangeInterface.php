<?php
namespace Xiaohuilam\LaravelTimePattern\Range\Interfaces;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

/**
 * @property Carbon $start
 * @property Carbon $to
 * @property integer $unit
 */
interface RangeInterface
{
    /**
     * @param Carbon|null $start
     * @param Carbon|null $to
     */
    public function __construct($start = null, $to = null);

    public function getLength();

    public function isLengthGreaterThan(RangeInterface $range);
}
