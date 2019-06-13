<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
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

        $result = [];
        $from = self::carbon();
        $to = self::carbon();

        foreach ($words as $item) {
            $stack = $item['word'];
            if ($item['tag'] != 't') {
                $result[] = [
                    'statement' => $stack,
                    'results' => [],
                ];
            }
            /**
             * @var ResultObject[]
             */
            $results = [];
            self::try($stack, $from, $to, $results);

            $result[] = [
                'statement' => $stack,
                'results' => $results,
            ];
        }
        return $result;
    }

    public static function try($sentence, &$from, &$to, &$results)
    {
        return (new Pipeline(app()))
            ->send([$sentence, &$from, &$to, &$results])
            ->through(self::$rules)
            ->via('try')
            ->thenReturn();
    }
}
