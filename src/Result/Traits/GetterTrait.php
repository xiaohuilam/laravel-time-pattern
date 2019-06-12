<?php
namespace Xiaohuilam\LaravelTimePattern\Result\Traits;

trait GetterTrait
{
    /**
     * 获取开始时间
     *
     * @return string
     */
    public function getFromDatetime()
    {
        $result = [];
        $date = [];
        $time = [];
        if ($this->getFromYear()) {
            $date[] = $this->getFromYear();
        }
        if ($this->getFromMonth()) {
            $date[] = $this->getFromMonth();
        }
        if ($this->getFromDay()) {
            $date[] = $this->getFromDay();
        }

        if ($this->getFromHour()) {
            $time[] = $this->getFromHour();
        }
        if ($this->getFromMinute()) {
            $time[] = $this->getFromMinute();
        }
        if ($this->getFromSecond()) {
            $time[] = $this->getFromSecond();
        }

        if (count($date)) {
            $result[] = implode('-', $date);
        }
        if (count($time)) {
            $result[] = implode(':', $time);
        }

        return implode(' ', $result);
    }

    /**
     * 获取结束时间
     *
     * @return string
     */
    public function getToDatetime()
    {
        $result = [];
        $date = [];
        $time = [];
        if ($this->getToYear()) {
            $date[] = $this->getToYear();
        }
        if ($this->getToMonth()) {
            $date[] = $this->getToMonth();
        }
        if ($this->getToDay()) {
            $date[] = $this->getToDay();
        }

        if ($this->getToHour()) {
            $time[] = $this->getToHour();
        }
        if ($this->getToMinute()) {
            $time[] = $this->getToMinute();
        }
        if ($this->getToSecond()) {
            $time[] = $this->getToSecond();
        }

        if (count($date)) {
            $result[] = implode('-', $date);
        }
        if (count($time)) {
            $result[] = implode(':', $time);
        }

        return implode(' ', $result);
    }


    /**
     * 获取开始年份
     *
     * @return int|null
     */
    public function getFromYear()
    {
        return $this->from_year;
    }

    /**
     * 获取开始月份
     *
     * @return int|null
     */
    public function getFromMonth()
    {
        return $this->from_month;
    }

    /**
     * 获取开始日
     *
     * @return int|null
     */
    public function getFromDay()
    {
        return $this->from_day;
    }

    /**
     * 获取开始时
     *
     * @return int|null
     */
    public function getFromHour()
    {
        return $this->from_hour;
    }

    /**
     * 获取开始分
     *
     * @return int|null
     */
    public function getFromMinute()
    {
        return $this->from_minute;
    }

    /**
     * 获取开始秒
     *
     * @return int|null
     */
    public function getFromSecond()
    {
        return $this->from_second;
    }

    /**
     * 获取结束年份
     *
     * @return int|null
     */
    public function getToYear()
    {
        return $this->to_year;
    }

    /**
     * 获取结束月份
     *
     * @return int|null
     */
    public function getToMonth()
    {
        return $this->to_month;
    }

    /**
     *获取结束始日
     *
     * @return int|null
     */
    public function getToDay()
    {
        return $this->to_day;
    }

    /**
     *获取结束始时
     *
     * @return int|null
     */
    public function getToHour()
    {
        return $this->to_hour;
    }

    /**
     *获取结束始分
     *
     * @return int|null
     */
    public function getToMinute()
    {
        return $this->to_minute;
    }

    /**
     *获取结束始秒
     *
     * @return int|null
     */
    public function getToSecond()
    {
        return $this->to_second;
    }

}
