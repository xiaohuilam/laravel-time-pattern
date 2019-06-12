<?php
namespace Xiaohuilam\LaravelTimePattern\Range;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;
use Xiaohuilam\LaravelTimePattern\Range\Interfaces\RangeInterface;

abstract class AbstractRange implements RangeInterface
{
    /**
     * @var Carbon
     */
    protected $start;

    /**
     * @var Carbon
     */
    protected $to;

    /**
     * @var integer
     */
    public $unit;

    /**
     * @param Carbon|null $start
     * @param Carbon|null $to
     */
    public function __construct($start = null, $to = null)
    {
        $this->start = $start;
        $this->to = $to;
    }

    public function getLength()
    {
        if (!$this->to) {
            return;
        }
        $this->to->diffInSeconds($this->start);
    }

    public function isLengthGreaterThan(RangeInterface $range)
    {
        if (!$this->getLength() && !$range->getLength()) {
            return $this->unit > $range->unit;
        }
        return $this->getLength() > $range->getLength();
    }
}
