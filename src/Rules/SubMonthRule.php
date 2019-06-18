<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class SubMonthRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     * *. 在本规则（其他规则不搭界）中，['为日期范围', '月份指定可空']
     *
     * @var array
     */
    protected $parterns = [
        '/上旬/i' => ['1-10'],
        '/中旬/i' => ['11-20'],
        '/下旬/i' => ['21-31'],

        '/11月底/i' => ['21-31', '11'],
        '/11月末/i' => ['21-31', '11'],
        '/11月初/i' => ['1-10', '11'],
        '/十一月底/i' => ['21-31', '11'],
        '/十一月末/i' => ['21-31', '11'],
        '/十一月初/i' => ['1-10', '11'],

        '/12月底/i' => ['21-31', '12'],
        '/12月末/i' => ['21-31', '12'],
        '/12月初/i' => ['1-10', '12'],
        '/十二月底/i' => ['21-31', '12'],
        '/十二月末/i' => ['21-31', '12'],
        '/十二月初/i' => ['1-10', '12'],

        '/1月底/i' => ['21-31', '1'],
        '/1月末/i' => ['21-31', '1'],
        '/1月初/i' => ['1-10', '1'],
        '/一月底/i' => ['21-31', '1'],
        '/一月末/i' => ['21-31', '1'],
        '/一月初/i' => ['1-10', '1'],

        '/2月底/i' => ['21-31', '2'],
        '/2月末/i' => ['21-31', '2'],
        '/2月初/i' => ['1-10', '2'],
        '/二月底/i' => ['21-31', '2'],
        '/二月末/i' => ['21-31', '2'],
        '/二月初/i' => ['1-10', '2'],

        '/3月底/i' => ['21-31', '3'],
        '/3月末/i' => ['21-31', '3'],
        '/3月初/i' => ['1-10', '3'],
        '/三月底/i' => ['21-31', '3'],
        '/三月末/i' => ['21-31', '3'],
        '/三月初/i' => ['1-10', '3'],

        '/4月底/i' => ['21-31', '4'],
        '/4月末/i' => ['21-31', '4'],
        '/4月初/i' => ['1-10', '4'],
        '/四月底/i' => ['21-31', '4'],
        '/四月末/i' => ['21-31', '4'],
        '/四月初/i' => ['1-10', '4'],

        '/5月底/i' => ['21-31', '5'],
        '/5月末/i' => ['21-31', '5'],
        '/5月初/i' => ['1-10', '5'],
        '/五月底/i' => ['21-31', '5'],
        '/五月末/i' => ['21-31', '5'],
        '/五月初/i' => ['1-10', '5'],

        '/6月底/i' => ['21-31', '6'],
        '/6月末/i' => ['21-31', '6'],
        '/6月初/i' => ['1-10', '6'],
        '/六月底/i' => ['21-31', '6'],
        '/六月末/i' => ['21-31', '6'],
        '/六月初/i' => ['1-10', '6'],

        '/7月底/i' => ['21-31', '7'],
        '/7月末/i' => ['21-31', '7'],
        '/7月初/i' => ['1-10', '7'],
        '/七月底/i' => ['21-31', '7'],
        '/七月末/i' => ['21-31', '7'],
        '/七月初/i' => ['1-10', '7'],

        '/8月底/i' => ['21-31', '8'],
        '/8月末/i' => ['21-31', '8'],
        '/8月初/i' => ['1-10', '8'],
        '/八月底/i' => ['21-31', '8'],
        '/八月末/i' => ['21-31', '8'],
        '/八月初/i' => ['1-10', '8'],

        '/9月底/i' => ['21-31', '9'],
        '/9月末/i' => ['21-31', '9'],
        '/9月初/i' => ['1-10', '9'],
        '/九月底/i' => ['21-31', '9'],
        '/九月末/i' => ['21-31', '9'],
        '/九月初/i' => ['1-10', '9'],

        '/10月底/i' => ['21-31', '10'],
        '/10月末/i' => ['21-31', '10'],
        '/10月初/i' => ['1-10', '10'],
        '/十月底/i' => ['21-31', '10'],
        '/十月末/i' => ['21-31', '10'],
        '/十月初/i' => ['1-10', '10'],

        '/月底/i' => ['21-31'],
        '/月末/i' => ['21-31'],
        '/月初/i' => ['1-10'],

        '/early (in|of) month/i' => ['1-10'],
        '/middle (in|of) month/i' => ['11-20'],
        '/mid (in|of) month/i' => ['11-20'],
        '/(end|ending) (in|of) month/i' => ['21-31'],
        '/early (in|of) the month/i' => ['1-10'],
        '/middle (in|of) the month/i' => ['11-20'],
        '/mid (in|of) the month/i' => ['11-20'],
        '/(end|ending) (in|of) the month/i' => ['21-31'],

        '/early (in|of) jan/i' => ['1-10', '1'],
        '/(middle|mid) (in|of) jan/i' => ['11-20', '1'],
        '/late (in|of) jan/i' => ['21-31', '1'],
        '/(end|ending) (in|of) jan/i' => ['21-31', '1'],

        '/early (in|of) feb/i' => ['1-10', '2'],
        '/(middle|mid) (in|of) feb/i' => ['11-20', '2'],
        '/late (in|of) feb/i' => ['21-31', '2'],
        '/(end|ending) (in|of) feb/i' => ['21-31', '2'],

        '/early (in|of) mar/i' => ['1-10', '3'],
        '/(middle|mid) (in|of) mar/i' => ['11-20', '3'],
        '/late (in|of) mar/i' => ['21-31', '3'],
        '/(end|ending) (in|of) mar/i' => ['21-31', '3'],

        '/early (in|of) april/i' => ['1-10', '4'],
        '/(middle|mid) (in|of) april/i' => ['11-20', '4'],
        '/late (in|of) april/i' => ['21-31', '4'],
        '/(end|ending) (in|of) april/i' => ['21-31', '4'],

        '/early (in|of) may/i' => ['1-10', '5'],
        '/(middle|mid) (in|of) may/i' => ['11-20', '5'],
        '/late (in|of) may/i' => ['21-31', '5'],
        '/(end|ending) (in|of) may/i' => ['21-31', '5'],

        '/early (in|of) june/i' => ['1-10', '6'],
        '/(middle|mid) (in|of) june/i' => ['11-20', '6'],
        '/late (in|of) june/i' => ['21-31', '6'],
        '/(end|ending) (in|of) june/i' => ['21-31', '6'],

        '/early (in|of) july/i' => ['1-10', '7'],
        '/(middle|mid) (in|of) july/i' => ['11-20', '7'],
        '/late (in|of) july/i' => ['21-31', '7'],
        '/(end|ending) (in|of) july/i' => ['21-31', '7'],

        '/early (in|of) aug/i' => ['1-10', '8'],
        '/(middle|mid) (in|of) aug/i' => ['11-20', '8'],
        '/late (in|of) aug/i' => ['21-31', '8'],
        '/(end|ending) (in|of) aug/i' => ['21-31', '8'],

        '/early (in|of) sep/i' => ['1-10', '9'],
        '/(middle|mid) (in|of) sep/i' => ['11-20', '9'],
        '/late (in|of) sep/i' => ['21-31', '9'],
        '/(end|ending) (in|of) sep/i' => ['21-31', '9'],

        '/early (in|of) oct/i' => ['1-10', '10'],
        '/(middle|mid) (in|of) oct/i' => ['11-20', '10'],
        '/late (in|of) oct/i' => ['21-31', '10'],
        '/(end|ending) (in|of) oct/i' => ['21-31', '10'],

        '/early (in|of) nov/i' => ['1-10', '11'],
        '/(middle|mid) (in|of) nov/i' => ['11-20', '11'],
        '/late (in|of) nov/i' => ['21-31', '11'],
        '/(end|ending) (in|of) nov/i' => ['21-31', '11'],

        '/early (in|of) dec/i' => ['1-10', '12'],
        '/(middle|mid) (in|of) dec/i' => ['11-20', '12'],
        '/late (in|of) dec/i' => ['21-31', '12'],
        '/(end|ending) (in|of) dec/i' => ['21-31', '12'],
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
                list($start, $end) = explode('-', $matches_into[0]);
                if (isset($matches_into[1])) {
                    $from->month = $to->month = $matches_into[1];
                    $from->day = $start;
                    $to->day = $end;
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
