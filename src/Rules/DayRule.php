<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Carbon;

class DayRule
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/今天/i' => ['today'],
        '/今日/i' => ['today'],
        '/today/i' => ['today'],
        '/tonight/i' => ['today'],
        '/this day/i' => ['today'],
        '/this night/i' => ['today'],
        '/the day before tomorrow/i' => ['today'],
        '/大前天/i' => ['-3 days'],
        '/前天/i' => ['-2 days'],
        '/the day before lastday/i' => ['-2 days'],
        '/the day before yesterday/i' => ['-2 days'],
        '/the day before last night/i' => ['-2 days'],
        '/昨天/i' => ['-1 days'],
        '/昨日/i' => ['-1 days'],
        '/yesterday/i' => ['-1 days'],
        '/lastday/i' => ['-1 days'],
        '/last night/i' => ['-1 days'],
        '/明天/i' => ['+1 days'],
        '/明日/i' => ['+1 days'],
        '/tomorrow/i' => ['+1 days'],
        '/next day/i' => ['+1 days'],
        '/the day after tomorrow/i' => ['+2 days'],
        '/the day after next day/i' => ['+2 days'],
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
                $mat->setFromCarbon($carbon->copy());
                $mat->setToCarbon($carbon->copy());
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}