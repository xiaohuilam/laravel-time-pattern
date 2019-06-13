<?php
namespace Xiaohuilam\LaravelTimePattern\Rules\Interfaces;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

interface RuleInterface
{
    /**
     * 分析
     *
     * @param array|Carbon[]|string[] $parameters
     * @param Closure $next
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($parameters, $next);

    /**
     * 返回carbon对象
     *
     * @return \Xiaohuilam\LaravelTimePattern\Date\Carbon
     */
    public static function carbon();
}
