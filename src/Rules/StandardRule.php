<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Str;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class StandardRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        // YYYY-mm-dd HH:ii:ss
        '/([\d]{4})[\W^\:^\ ]{1,4}([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2}) ([\d]{1,2})\:([\d]{1,2})\:([\d]{1,2})/' => ['year', 'month', 'day', 'hour', 'minute', 'second'],
        // YYYY-mm-dd HH:ii
        '/([\d]{4})[\W^\:^\ ]{1,4}([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2}) ([\d]{1,2})\:([\d]{1,2})/' => ['year', 'month', 'day', 'hour', 'minute'],
        // mm-dd-YYYY HH:ii:ss
        '/([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{4}) ([\d]{1,2})\:([\d]{1,2})\:([\d]{1,2})/' => ['month', 'day', 'year',  'hour', 'minute', 'second'],
        // YYYY-mm-dd
        '/([\d]{4})[\W^\:^\ ]{1,4}([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2})/' => ['year', 'month', 'day',],
        // YYYY-mm
        '/([\d]{4})[\W^\:^\ ]{1,4}([\d]{1,2})/' => ['year', 'month',],
        // YYYY年mm月
        '/([\d]{4})年([\d]{1,2})月/' => ['year', 'month',],
        // mm-dd-YYYY
        '/([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{4})/' => ['month', 'day', 'year',],
        // mm-dd
        '/([\d]{1,2})[\W^\:^\ ]{1,4}([\d]{1,2})/' => ['month', 'day',],
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
        list($sentense, $from, $to, $results, $stack) = $parameters;

        foreach ($this->parterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                redo:
                $from = self::carbon();
                $to = self::carbon();
                foreach ($matches_into as $index => $attribute) {
                    $from->set($attribute, $ret[$index + 1]);
                    $to->set($attribute, $ret[$index + 1]);
                }
                $mat = new ResultObject($from, $to);

                /**
                 * @var ResultObject $last
                 */
                $last = last($stack);
                if ($last && $mat->from === $from && $mat->to === $to && $last->isWideThan($mat)) {
                    $from_new = $from->copy();
                    $to_new = $to->copy();

                    $from = &$from_new;
                    $to = &$to_new;
                    $mat = new ResultObject($from, $to);
                    $stack[] = $mat;
                    goto redo;
                }
                $results = array_merge($results, [$mat]);
                return $next($parameters);
            }
        }

        return $next($parameters);
    }
}
