<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class SubDayRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     * *. 在本规则（其他规则不搭界）中，['为日期范围', '月份指定可空']
     *
     * @var array
     */
    protected $parterns = [
        '/昨晚/i' => ['17-22', '-1 days'],
        '/昨天晚上/i' => ['17-22', '-1 days'],
        '/last night/i' => ['17-22', '-1 days'],
        '/yesterday night/i' => ['17-22', '-1 days'],

        '/昨早/i' => ['6-9', '-1 days'],
        '/昨天早上/i' => ['6-9', '-1 days'],
        '/last morning/i' => ['6-9', '-1 days'],
        '/yesterday morning/i' => ['6-9', '-1 days'],

        '/明晚/i' => ['17-22', '+1 days'],
        '/明天晚上/i' => ['17-22', '+1 days'],
        '/tomorrow night/i' => ['17-22', '+1 days'],
        '/next night/i' => ['17-22', '+1 days'],

        '/明早/i' => ['6-9', '+1 days'],
        '/明天早上/i' => ['6-9', '+1 days'],
        '/tomorrow morning/i' => ['6-9', '+1 days'],
        '/next morning/i' => ['6-9', '+1 days'],

        '/早上/i' => ['6-9'],
        '/morning/i' => ['6-9'],
        '/上午/i' => ['8-11'],
        '/中午/i' => ['11-13'],
        '/晌午/i' => ['11-13'],
        '/下午/i' => ['13-17'],
        '/afternoon/i' => ['13-17'],
        '/noon/i' => ['11-13'],
        '/今晚/i' => ['17-22'],
        '/今天晚上/i' => ['17-22'],
        '/晚上/i' => ['17-22'],
        '/傍晚/i' => ['17-20'],
        '/tonight/i' => ['17-22'],
        '/this night/i' => ['17-22'],
        '/深夜/i' => ['22-24'],
        '/middle night/i' => ['22-24'],
        '/mid night/i' => ['22-24'],
        '/半夜/i' => ['22-24'],
        '/夜/i' => ['17-24'],
        '/凌晨/i' => ['0-4'],
        '/dawn/i' => ['0-4'],
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
                $carbon = self::carbon();

                list($start, $end) = explode('-', $matches_into[0]);
                $from->set('hour', $start);
                $to->set('hour', $end);

                if (isset($matches_into[1])) {
                    $carbon = $carbon->parse($matches_into[1]);

                    $from->set('year', $carbon->year);
                    $from->set('month', $carbon->month);
                    $from->set('day', $carbon->day);
                    $to->set('year', $carbon->year);
                    $to->set('month', $carbon->month);
                    $to->set('day', $carbon->day);
                }

                $mat = new ResultObject($from, $to);
                /**
                 * @var ResultObject $last
                 */
                $last = $stack->last();
                if ($last && $mat->from === $from && $mat->to === $to && $last->isWideThan($mat)) {
                    $from_new = $from->copy();
                    $to_new = $to->copy();

                    $from = &$from_new;
                    $to = &$to_new;
                    $mat = new ResultObject($from, $to);
                    $stack[] = $mat;
                    goto redo;
                }
                $results->push($mat);
                return $next($parameters);
            }
        }
        return $next($parameters);
    }
}
