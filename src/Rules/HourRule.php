<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class HourRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/([十一二三四五六七八九\d]{1,2})点整/i' => ['create' => '2019-01-01 00:00:00', 'sets' => ['minute',]],
        '/([十一二三四五六七八九\d]{1,2})点半/i' => ['create' => '2019-01-01 00:30:00', 'sets' => ['minute',]],
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

        foreach ($this->parterns as $regex => $matches_into) {
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
