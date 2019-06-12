<?php
namespace Xiaohuilam\LaravelTimePattern\Result\Traits;

trait SetterTrait
{
    /**
     * 开始年份
     *
     * @param int|null
     */
    public function setFromYear($from_year)
    {
        $this->from_year = (int)$from_year;
        return $this;
    }

    /**
     * 开始月份
     *
     * @param int|null
     */
    public function setFromMonth($from_month)
    {
        $this->from_month = (int)$from_month;
        return $this;
    }

    /**
     * 开始日
     *
     * @param int|null
     */
    public function setFromDay($from_day)
    {
        $this->from_day = (int)$from_day;
        return $this;
    }

    /**
     * 开始时
     *
     * @param int|null
     */
    public function setFromHour($from_hour)
    {
        $this->from_hour = (int)$from_hour;
        return $this;
    }

    /**
     * 开始分
     *
     * @param int|null
     */
    public function setFromMinute($from_minute)
    {
        $this->from_minute = (int)$from_minute;
        return $this;
    }

    /**
     * 开始秒
     *
     * @param int|null
     */
    public function setFromSecond($from_second)
    {
        $this->from_second = (int)$from_second;
        return $this;
    }

    /**
     * 结束年份
     *
     * @param int|null
     */
    public function setToYear($to_year)
    {
        $this->to_year = (int)$to_year;
        return $this;
    }

    /**
     * 结束月份
     *
     * @param int|null
     */
    public function setToMonth($to_month)
    {
        $this->to_month = (int)$to_month;
        return $this;
    }

    /**
     *结束始日
     *
     * @param int|null
     */
    public function setToDay($to_day)
    {
        $this->to_day = (int)$to_day;
        return $this;
    }

    /**
     *结束始时
     *
     * @param int|null
     */
    public function setToHour($to_hour)
    {
        $this->to_hour = (int)$to_hour;
        return $this;
    }

    /**
     *结束始分
     *
     * @param int|null
     */
    public function setToMinute($to_minute)
    {
        $this->to_minute = (int)$to_minute;
        return $this;
    }

    /**
     *结束始秒
     *
     * @param int|null
     */
    public function setToSecond($to_second)
    {
        $this->to_second = (int)$to_second;
        return $this;
    }
}
