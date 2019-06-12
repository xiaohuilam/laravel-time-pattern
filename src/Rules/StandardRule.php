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
     * @param string $sentense
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $from
     * @param \Xiaohuilam\LaravelTimePattern\Date\Carbon $to
     *
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense, $from, $to)
    {
        /**
         * @var \Xiaohuilam\LaravelTimePattern\Result\ResultObject[] $results
         */
        $results = [];
        foreach ($this->parterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                $from = self::carbon();
                $to = self::carbon();
                foreach ($matches_into as $index => $attribute) {
                    $from->set($attribute, $ret[$index + 1]);
                    $to->set($attribute, $ret[$index + 1]);
                }
                $mat = new ResultObject($from, $to);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
