<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;

class Partern
{
    /**
     * @var RuleInterface[]
     */
    protected static $rules = [
        Rules\StandardRule::class,
        Rules\SubMonthRule::class,
        Rules\MonthRule::class,
        Rules\DayRule::class,
    ];

    public static function try($sentense)
    {
        /**
         * @var ResultObject[]
         */
        $results = [];
        foreach (self::$rules as $rule_class) {
            /**
             * @var RuleInterface $rule
             */
            $rule = new $rule_class;
            $results = array_merge($results, $rule->try($sentense));
        }

        return $results;
    }
}