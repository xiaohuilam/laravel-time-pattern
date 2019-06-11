<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Carbon;

class WeekRule
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/^本周$/i' => ['this week'],
        '/^上周$/i' => ['-1 week'],
        '/^下周$/i' => ['+1 week'],
        '/^this week$/i' => ['this week'],
        '/^last week$/i' => ['-1 week'],
        '/^previous week$/i' => ['-1 week'],
        '/^next week$/i' => ['+1 week'],
    ];

    /**
     * 分析
     *
     * @param string $sentense
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense)
    {
        /**
         * @var $results \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
         */
        $results = [];
        foreach ($this->parterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                $mat = new ResultObject();
                $carbon = Carbon::parse($matches_into[0]);
                $mat->setFromMonth($carbon->copy()->firstOfMonth()->month);
                $mat->setToMonth($carbon->copy()->endOfMonth()->month);
                $mat->setFromDay($carbon->copy()->firstOfMonth()->day);
                $mat->setToDay($carbon->copy()->endOfMonth()->day);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
