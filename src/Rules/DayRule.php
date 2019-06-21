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
    protected $patterns = [
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
     * @param array|Carbon[]|string[] $parameters
     * @param Closure $next
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function process($parameters, $next)
    {
        /**
         * @var \Xiaohuilam\LaravelTimePattern\Result\ResultObject[] $results
         */
        list($sentense, $from, $to, $results, $stack) = $parameters;

        foreach ($this->patterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                redo:
                $carbon = self::carbon()->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $from = $from->set($set, $carbon->{$set});
                    $to = $to->set($set, $carbon->{$set});
                }

                $mat = new ResultObject($from, $to);
                /**
                 * @var ResultObject $last
                 */
                $last = $stack->last();
                if ($last && $mat->from === $from && $mat->to === $to && $last->isWideThan($mat)) {
                    $from_new = $from->copy();
                    $to_new = $to->copy();

                    $from = &$from_new;
                    $to = &$to_new;
                    $mat = new ResultObject($from, $to);
                    $stack[] = $mat;
                    goto redo;
                }
                $results->push($mat);
                return $next($parameters);
            }
        }
        return $next($parameters);
    }
}