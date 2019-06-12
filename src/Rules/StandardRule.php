<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Str;

class StandardRule
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        // YYYY-mm-dd HH:ii:ss
        '/([\d]{4})[\W^\:^\ ]+([\d]{1,2})[\W^\:^\ ]+([\d]{1,2}) ([\d]{1,2})\:([\d]{1,2})\:([\d]{1,2})/' => ['year', 'month', 'day', 'hour', 'minute', 'second'],
        // YYYY-mm-dd HH:ii
        '/([\d]{4})[\W^\:^\ ]+([\d]{1,2})[\W^\:^\ ]+([\d]{1,2}) ([\d]{1,2})\:([\d]{1,2})/' => ['year', 'month', 'day', 'hour', 'minute'],
        // mm-dd-YYYY HH:ii:ss
        '/([\d]{1,2})[\W^\:^\ ]+([\d]{1,2})[\W^\:^\ ]+([\d]{4}) ([\d]{1,2})\:([\d]{1,2})\:([\d]{1,2})/' => ['month', 'day', 'year',  'hour', 'minute', 'second'],
        // YYYY-mm-dd
        '/([\d]{4})[\W^\:^\ ]+([\d]{1,2})[\W^\:^\ ]+([\d]{1,2})/' => ['year', 'month', 'day',],
        // YYYY-mm
        '/([\d]{4})[\W^\:^\ ]+([\d]{1,2})/' => ['year', 'month',],
        // mm-dd-YYYY
        '/([\d]{1,2})[\W^\:^\ ]+([\d]{1,2})[\W^\:^\ ]+([\d]{4})/' => ['month', 'day', 'year',],
        // mm-dd
        '/([\d]{1,2})[\W^\:^\ ]+([\d]{1,2})/' => ['month', 'day',],
    ];

    /**
     * 分析
     *
     * @param string $sentense
     * @return \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
     */
    public function try($sentense)
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
                $mat = new ResultObject();
                foreach ($matches_into as $index => $attribute) {
                    foreach (['from', 'to'] as $fromTo) {
                        $method = Str::camel('set_' . $fromTo . '_' . $attribute);
                        $mat->{$method}($ret[$index + 1]);
                    }
                }
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
