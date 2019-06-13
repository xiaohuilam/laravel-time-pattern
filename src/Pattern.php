<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Traits\HasCarbon;
use Illuminate\Pipeline\Pipeline;

class Pattern
{
    use HasCarbon;

    /**
     * @var RuleInterface[]
     */
    public static $rules = [
        Rules\StandardRule::class,
        Rules\SubMonthRule::class,
        Rules\MonthRule::class,
        Rules\DayRule::class,
        Rules\WeekRule::class,
        Rules\SubDayRule::class,
        Rules\HourRule::class,
        Rules\YearRule::class,
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
        $words = collect($words)->values();

        $from = self::carbon();
        $to = self::carbon();

        $ret = [];

        $stack = [];

        //dd($words->take(3), $words);
        $words = $words->toArray();

        return (new Pipeline(app()))
            ->send([&$from, &$to, &$ret, &$stack])
            ->through($words)
            ->via('parse')
            ->thenReturn();
    }

    public static function try($sentence, &$from, &$to, &$results, &$stack)
    {
        return (new Pipeline(app()))
            ->send([$sentence, &$from, &$to, &$results, &$stack])
            ->through(self::$rules)
            ->via('parse')
            ->thenReturn();
    }
}
