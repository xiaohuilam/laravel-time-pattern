<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Traits\HasCarbon;

abstract class AbstractRule
{
    use HasCarbon;

    /**
     * 分析
     *
     * @param array|Carbon[]|string[] $parameters
     * @param Closure $next
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function parse($parameters, $next)
    {
        //dump($parameters[0], static::class);
        return $this->try($parameters, $next);
    }
}

