<?php
namespace Xiaohuilam\LaravelTimePattern\Participle\Interfaces;

interface ParticipleInterface
{
    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence);
}
