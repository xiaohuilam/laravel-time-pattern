<?php
namespace Xiaohuilam\LaravelTimePattern\Result;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

class ResultObject
{
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

    /**
     * 获取开始时间
     *
     * @return string
     */
    public function getFromDatetime()
    {
        return implode(' ', [
            implode('-', [$this->from_year, $this->from_month, $this->from_day,]),
            implode(':', [$this->from_hour, $this->from_minute, $this->from_second,]),
        ]);
    }

    /**
     * 获取结束时间
     *
     * @return string
     */
    public function getToDatetime()
    {
        return implode(' ', [
            implode('-', [$this->to_year, $this->to_month, $this->to_day,]),
            implode(':', [$this->to_hour, $this->to_minute, $this->to_second,]),
        ]);
    }

    /**
     * 获取开始时间
     * @param Carbon $carbon
     * @return string
     */
    public function setFromCarbon($carbon)
    {
        $this->setFromYear($carbon->year);
        $this->setFromMonth($carbon->month);
        $this->setFromDay($carbon->day);
        $this->setFromHour($carbon->hour);
        $this->setFromMinute($carbon->minute);
        $this->setFromSecond($carbon->second);
    }

    /**
     * 获取开始时间
     * @param \Carbon\Carbon $carbon
     * @return string
     */
    public function setToCarbon($carbon)
    {
        $this->setToYear($carbon->year);
        $this->setToMonth($carbon->month);
        $this->setToDay($carbon->day);
        $this->setToHour($carbon->hour);
        $this->setToMinute($carbon->minute);
        $this->setToSecond($carbon->second);
    }

    /**
     * 开始年份
     *
     * @var int|null
     */
    public function setFromYear($from_year)
    {
        $this->from_year = (int) $from_year;
    }

    /**
     * 开始月份
     *
     * @var int|null
     */
    public function setFromMonth($from_month)
    {
        $this->from_month = (int) $from_month;
    }

    /**
     * 开始日
     *
     * @var int|null
     */
    public function setFromDay($from_day)
    {
        $this->from_day = (int) $from_day;
    }

    /**
     * 开始时
     *
     * @var int|null
     */
    public function setFromHour($from_hour)
    {
        $this->from_hour = (int) $from_hour;
    }

    /**
     * 开始分
     *
     * @var int|null
     */
    public function setFromMinute($from_minute)
    {
        $this->from_minute = (int) $from_minute;
    }

    /**
     * 开始秒
     *
     * @var int|null
     */
    public function setFromSecond($from_second)
    {
        $this->from_second = (int) $from_second;
    }

    /**
     * 结束年份
     *
     * @var int|null
     */
    public function setToYear($to_year)
    {
        $this->to_year = (int) $to_year;
    }

    /**
     * 结束月份
     *
     * @var int|null
     */
    public function setToMonth($to_month)
    {
        $this->to_month = (int) $to_month;
    }

    /**
     *结束始日
     *
     * @var int|null
     */
    public function setToDay($to_day)
    {
        $this->to_day = (int) $to_day;
    }

    /**
     *结束始时
     *
     * @var int|null
     */
    public function setToHour($to_hour)
    {
        $this->to_hour = (int) $to_hour;
    }

    /**
     *结束始分
     *
     * @var int|null
     */
    public function setToMinute($to_minute)
    {
        $this->to_minute = (int) $to_minute;
    }

    /**
     *结束始秒
     *
     * @var int|null
     */
    public function setToSecond($to_second)
    {
        $this->to_second = (int) $to_second;
    }
}
