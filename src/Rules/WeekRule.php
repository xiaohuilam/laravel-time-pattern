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
    protected $patterns = [
        '/本周/i' => ['create' => 'this week', 'sets' => ['year', 'month', 'day',]],
        '/上上周/i' => ['create' => '-2 week', 'sets' => ['year', 'month', 'day',]],
        '/上周/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/下下周/i' => ['create' => '+2 week', 'sets' => ['year', 'month', 'day',]],
        '/下周/i' => ['create' => '+1 week', 'sets' => ['year', 'month', 'day',]],
        '/this week/i' => ['create' => 'this week', 'sets' => ['year', 'month', 'day',]],
        '/last week/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/previous week/i' => ['create' => '-1 week', 'sets' => ['year', 'month', 'day',]],
        '/next week/i' => ['create' => '+1 week', 'sets' => ['year', 'month', 'day',]],
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
                $from = $from->set('month', $carbon->copy()->startOfWeek()->month);
                $from = $from->set('day', $carbon->copy()->startOfWeek()->day);
                $to = $to->set('month', $carbon->copy()->endOfWeek()->month);
                $to = $to->set('day', $carbon->copy()->endOfWeek()->day);

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
