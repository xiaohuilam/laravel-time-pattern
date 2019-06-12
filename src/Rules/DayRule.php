<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class DayRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/今天/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/今日/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/today/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/tonight/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/this day/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/this night/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/the day before tomorrow/i' => ['create' => 'today', 'sets' => ['year', 'month', 'day',]],
        '/大前天/i' => ['create' => '-3 days', 'sets' => ['year', 'month', 'day',]],
        '/前天/i' => ['create' => '-2 days', 'sets' => ['year', 'month', 'day',]],
        '/the day before lastday/i' => ['create' => '-2 days', 'sets' => ['year', 'month', 'day',]],
        '/the day before yesterday/i' => ['create' => '-2 days', 'sets' => ['year', 'month', 'day',]],
        '/the day before last night/i' => ['create' => '-2 days', 'sets' => ['year', 'month', 'day',]],
        '/昨天/i' => ['create' => '-1 days', 'sets' => ['year', 'month', 'day',]],
        '/昨日/i' => ['create' => '-1 days', 'sets' => ['year', 'month', 'day',]],
        '/yesterday/i' => ['create' => '-1 days', 'sets' => ['year', 'month', 'day',]],
        '/lastday/i' => ['create' => '-1 days', 'sets' => ['year', 'month', 'day',]],
        '/last night/i' => ['create' => '-1 days', 'sets' => ['year', 'month', 'day',]],
        '/明天/i' => ['create' => '+1 days', 'sets' => ['year', 'month', 'day',]],
        '/明日/i' => ['create' => '+1 days', 'sets' => ['year', 'month', 'day',]],
        '/tomorrow/i' => ['create' => '+1 days', 'sets' => ['year', 'month', 'day',]],
        '/next day/i' => ['create' => '+1 days', 'sets' => ['year', 'month', 'day',]],
        '/in (one|1) day/i' => ['create' => '+1 days', 'sets' => ['year', 'month', 'day',]],
        '/the day after tomorrow/i' => ['create' => '+2 days', 'sets' => ['year', 'month', 'day',]],
        '/the day after next day/i' => ['create' => '+2 days', 'sets' => ['year', 'month', 'day',]],
    ];

    /**
     * 分析
     *
     * @param string $sentense
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $from
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $to
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense, $from, $to)
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
                $carbon = self::carbon()->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $from = $from->set($set, $carbon->{$set});
                    $to = $to->set($set, $carbon->{$set});
                }

                $mat = new ResultObject($from, $to);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}