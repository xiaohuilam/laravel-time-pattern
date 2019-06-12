<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class WeekRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/本周/i' => ['create' => 'this week', 'sets' => ['year', 'month', 'day',]],
        '/上周/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/下周/i' => ['create' => '+1 week', 'sets' => ['year', 'month', 'day',]],
        '/this week/i' => ['create' => 'this week', 'sets' => ['year', 'month', 'day',]],
        '/last week/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/previous week/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/next week/i' => ['create' => '+1 week', 'sets' => ['year', 'month', 'day',]],
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
                $from = $from->set('month', $carbon->copy()->firstOfMonth()->month);
                $from = $from->set('day', $carbon->copy()->firstOfMonth()->day);
                $to = $to->set('month', $carbon->copy()->endOfMonth()->month);
                $to = $to->set('day', $carbon->copy()->endOfMonth()->day);

                $mat = new ResultObject($from, $to);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
