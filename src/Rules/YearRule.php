<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class YearRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/今年/i' => ['create' => '+0year', 'sets' => ['year',],],
        '/明年/i' => ['create' => '+1year', 'sets' => ['year',],],
        '/一年后/i' => ['create' => '+1year', 'sets' => ['year',],],
        '/两年后/i' => ['create' => '+2year', 'sets' => ['year',],],
        '/三年后/i' => ['create' => '+3year', 'sets' => ['year',],],
        '/前年/i' => ['create' => '-2year', 'sets' => ['year',],],
        '/后年/i' => ['create' => '+2year', 'sets' => ['year',],],
        '/一年前/i' => ['create' => '-1year', 'sets' => ['year',],],
        '/两年前/i' => ['create' => '-2year', 'sets' => ['year',],],
        '/三年前/i' => ['create' => '-3year', 'sets' => ['year',],],
        '/去年/i' => ['create' => '-1year', 'sets' => ['year',],],
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
                $from = $from->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $from = $from->set($set, $from->{$set});
                }
                $to = $to->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $to = $to->set($set, $to->{$set});
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
