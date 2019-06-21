<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Illuminate\Support\Str;
use Xiaohuilam\LaravelTimePattern\Date\Carbon;

class DayRangeRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $patterns = [
        '/([\d]{4})[\W\:^\ ^-]([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})\-([\d]{4})[\W\:^\ ^-]([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})/' => ['from_year', 'from_month', 'from_day', 'to_year', 'to_month', 'to_day',],
        '/([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})\-([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})/' => ['from_month', 'from_day', 'to_month', 'to_day',],
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

                $carbon_from = Carbon::now();
                $carbon_to = Carbon::now();
                foreach ($matches_into as $i => $attr) {
                    if (Str::startsWith($attr, 'from_')) {
                        $set = str_replace('from_', '', $attr);
                        $carbon_from->set($set, $ret[$i + 1]);
                    } else if (Str::startsWith($attr, 'to_')) {
                        $set = str_replace('to_', '', $attr);
                        $carbon_to->set($set, $ret[$i + 1]);
                    }
                }
                foreach ($carbon_from->getSets() as $set) {
                    $from = $from->set($set, $carbon_from->{$set});
                    $to = $to->set($set, $carbon_to->{$set});
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