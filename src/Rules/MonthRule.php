<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;

class MonthRule extends AbstractRule implements RuleInterface
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/本月今天/i' => ['create' => '+0month', 'sets' => ['month',],],
        '/本月今日/i' => ['create' => '+0month', 'sets' => ['month',],],
        '/上上月今天/i' => ['create' => '-2month', 'sets' => ['month',],],
        '/上上月今日/i' => ['create' => '-2month', 'sets' => ['month',],],
        '/上月今天/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/上月今日/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/下下月今天/i' => ['create' => '+2month', 'sets' => ['month',],],
        '/下下月今日/i' => ['create' => '+2month', 'sets' => ['month',],],
        '/下月今天/i' => ['create' => '+1month', 'sets' => ['month',],],
        '/下月今日/i' => ['create' => '+1month', 'sets' => ['month',],],
        '/month before last month/i' => ['create' => '-2month', 'sets' => ['month',],],
        '/two months ago/i' => ['create' => '-2month', 'sets' => ['month',],],
        '/2 months ago/i' => ['create' => '-2month', 'sets' => ['month',],],
        '/three months ago/i' => ['create' => '-3month', 'sets' => ['month',],],
        '/3 months ago/i' => ['create' => '-3month', 'sets' => ['month',],],
        '/four months ago/i' => ['create' => '-4month', 'sets' => ['month',],],
        '/4 months ago/i' => ['create' => '-4month', 'sets' => ['month',],],
        '/last mon[\t\W]{0,1}/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/perv mon[\t\W]{0,1}/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/previous mon[\t\W]{0,1}/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/previously mon[\t\W]{0,1}/i' => ['create' => '-1month', 'sets' => ['month',],],
        '/next mon[\t\W]{0,1}/i' => ['create' => '+1month', 'sets' => ['month',],],
        '/month later/i' => ['create' => '+1month', 'sets' => ['month',],],
        '/following mon[\t\W]{0,1}/i' => ['create' => '+1month', 'sets' => ['month',],],
        '/this mon[\t\W]{0,1}/i' => ['create' => 'month', 'sets' => ['month',],],
        '/in one mon[\t\W]{0,1}/i' => ['create' => 'month', 'sets' => ['month',],],
        '/current mon[\t\W]{0,1}/i' => ['create' => 'month', 'sets' => ['month',],],
        '/January/i' => ['create' => 'January', 'sets' => ['month',],],
        '/1月/i' => ['create' => 'January', 'sets' => ['month',],],
        '/一月/i' => ['create' => 'January', 'sets' => ['month',],],
        '/jan/i' => ['create' => 'January', 'sets' => ['month',],],
        '/february/i' => ['create' => 'February', 'sets' => ['month',],],
        '/2月/i' => ['create' => 'February', 'sets' => ['month',],],
        '/二月/i' => ['create' => 'February', 'sets' => ['month',],],
        '/feb/i' => ['create' => 'February', 'sets' => ['month',],],
        '/march/i' => ['create' => 'March', 'sets' => ['month',],],
        '/3月/i' => ['create' => 'March', 'sets' => ['month',],],
        '/三月/i' => ['create' => 'March', 'sets' => ['month',],],
        '/mar/i' => ['create' => 'March', 'sets' => ['month',],],
        '/april/i' => ['create' => 'April', 'sets' => ['month',],],
        '/4月/i' => ['create' => 'April', 'sets' => ['month',],],
        '/四月/i' => ['create' => 'April', 'sets' => ['month',],],
        '/apr/i' => ['create' => 'April', 'sets' => ['month',],],
        '/may/i' => ['create' => 'May', 'sets' => ['month',],],
        '/5月/i' => ['create' => 'May', 'sets' => ['month',],],
        '/五月/i' => ['create' => 'May', 'sets' => ['month',],],
        '/ma/i' => ['create' => 'May', 'sets' => ['month',],],
        '/june/i' => ['create' => 'June', 'sets' => ['month',],],
        '/6月/i' => ['create' => 'June', 'sets' => ['month',],],
        '/六月/i' => ['create' => 'June', 'sets' => ['month',],],
        '/jun/i' => ['create' => 'June', 'sets' => ['month',],],
        '/july/i' => ['create' => 'July', 'sets' => ['month',],],
        '/7月/i' => ['create' => 'July', 'sets' => ['month',],],
        '/七月/i' => ['create' => 'July', 'sets' => ['month',],],
        '/jul/i' => ['create' => 'July', 'sets' => ['month',],],
        '/august/i' => ['create' => 'August', 'sets' => ['month',],],
        '/8月/i' => ['create' => 'August', 'sets' => ['month',],],
        '/八月/i' => ['create' => 'August', 'sets' => ['month',],],
        '/aug/i' => ['create' => 'August', 'sets' => ['month',],],
        '/september/i' => ['create' => 'September', 'sets' => ['month',],],
        '/9月/i' => ['create' => 'September', 'sets' => ['month',],],
        '/九月/i' => ['create' => 'September', 'sets' => ['month',],],
        '/sep/i' => ['create' => 'September', 'sets' => ['month',],],
        '/october/i' => ['create' => 'October', 'sets' => ['month',],],
        '/10月/i' => ['create' => 'October', 'sets' => ['month',],],
        '/十月/i' => ['create' => 'October', 'sets' => ['month',],],
        '/oct/i' => ['create' => 'October', 'sets' => ['month',],],
        '/november/i' => ['create' => 'November', 'sets' => ['month',],],
        '/11月/i' => ['create' => 'November', 'sets' => ['month',],],
        '/十一月/i' => ['create' => 'November', 'sets' => ['month',],],
        '/nov/i' => ['create' => 'November', 'sets' => ['month',],],
        '/december/i' => ['create' => 'December', 'sets' => ['month',],],
        '/12月/i' => ['create' => 'December', 'sets' => ['month',],],
        '/十二月/i' => ['create' => 'December', 'sets' => ['month',],],
        '/dec/i' => ['create' => 'December', 'sets' => ['month',],],
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
        list($sentense, &$from, &$to, &$results) = $parameters;

        foreach ($this->parterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                $from = $from->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $from = $from->set($set, $from->{$set});

                }
                $to = $to->parse($matches_into['create']);
                foreach ($matches_into['sets'] as $set) {
                    $to = $to->set($set, $to->{$set});
                }

                $mat = new ResultObject($from, $to);
                $results = array_merge($results, [$mat]);
                return $next($parameters);
            }
        }
        return $next($parameters);
    }
}
