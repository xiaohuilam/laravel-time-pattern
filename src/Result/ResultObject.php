<?php
namespace Xiaohuilam\LaravelTimePattern\Result;

use Xiaohuilam\LaravelTimePattern\Result\Traits\GetterTrait;
use Xiaohuilam\LaravelTimePattern\Result\Traits\SetterTrait;
use Xiaohuilam\LaravelTimePattern\Result\Traits\ConstructorTrait;
use Xiaohuilam\LaravelTimePattern\Result\Traits\FeatureTrait;

class ResultObject
{
    use GetterTrait, SetterTrait, ConstructorTrait, FeatureTrait;

    /**
     * 开始年份
     *
     * @var int|null
     */
    protected $from_year = null;

    /**
     * 开始月份
     *
     * @var int|null
     */
    protected $from_month = null;

    /**
     * 开始日
     *
     * @var int|null
     */
    protected $from_day = null;

    /**
     * 开始时
     *
     * @var int|null
     */
    protected $from_hour = null;

    /**
     * 开始分
     *
     * @var int|null
     */
    protected $from_minute = null;

    /**
     * 开始秒
     *
     * @var int|null
     */
    protected $from_second = null;

    /**
     * 结束年份
     *
     * @var int|null
     */
    protected $to_year = null;

    /**
     * 结束月份
     *
     * @var int|null
     */
    protected $to_month = null;

    /**
     *结束始日
     *
     * @var int|null
     */
    protected $to_day = null;

    /**
     *结束始时
     *
     * @var int|null
     */
    protected $to_hour = null;

    /**
     *结束始分
     *
     * @var int|null
     */
    protected $to_minute = null;

    /**
     *结束始秒
     *
     * @var int|null
     */
    protected $to_second = null;
}
