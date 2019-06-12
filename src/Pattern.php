<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Traits\HasCarbon;

class Pattern
{
    use HasCarbon;

    /**
     * @var RuleInterface[]
     */
    protected static $rules = [
        Rules\StandardRule::class,
        Rules\SubMonthRule::class,
        Rules\MonthRule::class,
        Rules\DayRule::class,
        Rules\WeekRule::class,
        Rules\SubDayRule::class,
        Rules\HourRule::class,
    ];

    /**
     * 分词后分析
     *
     * @param string $sentence
     * @param bool $greedy 贪婪模式
     */
    public static function parse($sentence, $greedy = true)
    {
        $words = collect([]);
        foreach (config('nlp_time_pattern.participles') as $participle) {
            $results = call_user_func([$participle, 'run'], $sentence);
            $words = $words->merge($results);
        }
        $words = collect($words)->where('tag', 't')->values();

        $stacks = $words->pluck('word')->values();
        $result = [];
        $from = self::carbon();
        $to = self::carbon();

        foreach ($stacks as $stack) {
            $result[$stack] = self::try($stack, $from, $to);
        }
        return $result;
    }

    public static function try($sentence, $from, $to)
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
            $results = array_merge($results, $rule->try($sentence, $from, $to));
        }

        return $results;
    }
}
