<?php
namespace Xiaohuilam\LaravelTimePattern\Rules\Interfaces;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

interface RuleInterface
{
    /**
     * 分析
     *
     * @param string $sentense
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $from
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $to
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense, $from, $to);

    /**
     * 返回carbon对象
     *
     * @return \Xiaohuilam\LaravelTimePattern\Date\Carbon
     */
    public static function carbon();
}
