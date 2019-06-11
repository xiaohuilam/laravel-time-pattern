<?php
namespace Xiaohuilam\LaravelTimePattern\Rules\Interfaces;

interface RuleInterface
{
    /**
     * 分析
     *
     * @param string $sentense
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense);
}
