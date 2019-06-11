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
        '/^今天$/i' => ['today'],
        '/^今日$/i' => ['today'],
        '/^today$/i' => ['today'],
        '/^tonight$/i' => ['today'],
        '/^this day$/i' => ['today'],
        '/^this night$/i' => ['today'],
        '/^the day before tomorrow$/i' => ['today'],
        '/^大前天$/i' => ['-3day'],
        '/^前天$/i' => ['-2day'],
        '/^the day before lastday$/i' => ['-2day'],
        '/^the day before yesterday$/i' => ['-2day'],
        '/^the day before last night$/i' => ['-2day'],
        '/^昨天$/i' => ['-1day'],
        '/^昨日$/i' => ['-1day'],
        '/^tomorrow$/i' => ['-1day'],
        '/^lastday$/i' => ['-1day'],
        '/^last night$/i' => ['-1day'],
        '/^tomorrow$/i' => ['+1day'],
        '/^next day$/i' => ['+1day'],
        '/^the day after tomorrow$/i' => ['+2day'],
        '/^the day after next day$/i' => ['+2day'],
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
                $mat->setFromDay(Carbon::today()->day);
                $mat->setToDay(Carbon::today()->day);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}