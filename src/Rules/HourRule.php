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
                $mat = new ResultObject();
                $carbon = self::carbon()->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $from = $from->set($set, $carbon->{$set});
                    $to = $to->set($set, $carbon->{$set});
                }

                $mat->setFromCarbon($from);
                $mat->setToCarbon($to);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
