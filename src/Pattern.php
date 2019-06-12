<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;

class Pattern
{
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
            $results = call_user_func([$participle, 'parts'], $sentence);
            $words = $words->merge($results);
        }

        $stacks = [];

        foreach($words as $word) {
            $need_parse = false;
            //@TODO: 1月 2月 tag为m
            if (data_get($word, 'tag') == 't'){
                $need_parse = true;
            } else if (data_get($word, 'tag') == 't') {
                $need_parse = true;
            }
            if (!$need_parse) {
                continue;
            }

            $stacks[] = $word['word'];
        }
        $result = [];
        foreach ($stacks as $stack) {
            $result[$stack] = self::try($stack);
        }
        return $result;
    }

    public static function try($sentence)
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
            $results = array_merge($results, $rule->try($sentence));
        }

        return $results;
    }
}
