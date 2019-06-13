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
    public function try($parameters, $next)
    {
        /**
         * @var \Xiaohuilam\LaravelTimePattern\Result\ResultObject[] $results
         */
        list($sentense, &$from, &$to, &$results) = $parameters;

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
                return $next($parameters);
            }
        }
        return $next($parameters);
    }
}
