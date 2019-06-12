<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Carbon;

class MonthRule
{
    /**
     * 顺序敏感
     *
     * @var array
     */
    protected $parterns = [
        '/本月今天/i' => ['+0month'],
        '/本月今日/i' => ['+0month'],
        '/上上月今天/i' => ['-2month'],
        '/上上月今日/i' => ['-2month'],
        '/上月今天/i' => ['-1month'],
        '/上月今日/i' => ['-1month'],
        '/下下月今天/i' => ['+2month'],
        '/下下月今日/i' => ['+2month'],
        '/下月今天/i' => ['+1month'],
        '/下月今日/i' => ['+1month'],
        '/month before last month/i' => ['-2month'],
        '/two months ago/i' => ['-2month'],
        '/2 months ago/i' => ['-2month'],
        '/three months ago/i' => ['-3month'],
        '/3 months ago/i' => ['-3month'],
        '/four months ago/i' => ['-4month'],
        '/4 months ago/i' => ['-4month'],
        '/last mon[\t\W]{0,1}/i' => ['-1month'],
        '/perv mon[\t\W]{0,1}/i' => ['-1month'],
        '/previous mon[\t\W]{0,1}/i' => ['-1month'],
        '/previously mon[\t\W]{0,1}/i' => ['-1month'],
        '/next mon[\t\W]{0,1}/i' => ['+1month'],
        '/month later/i' => ['+1month'],
        '/following mon[\t\W]{0,1}/i' => ['+1month'],
        '/this mon[\t\W]{0,1}/i' => ['month'],
        '/in one mon[\t\W]{0,1}/i' => ['month'],
        '/current mon[\t\W]{0,1}/i' => ['month'],
        '/January/i' => ['January',],
        '/1月/i' => ['January',],
        '/一月/i' => ['January',],
        '/jan/i' => ['January',],
        '/february/i' => ['February',],
        '/2月/i' => ['February',],
        '/二月/i' => ['February',],
        '/feb/i' => ['February',],
        '/march/i' => ['March',],
        '/3月/i' => ['March',],
        '/三月/i' => ['March',],
        '/mar/i' => ['March',],
        '/april/i' => ['April',],
        '/4月/i' => ['April',],
        '/四月/i' => ['April',],
        '/apr/i' => ['April',],
        '/may/i' => ['May',],
        '/5月/i' => ['May',],
        '/五月/i' => ['May',],
        '/ma/i' => ['May',],
        '/june/i' => ['June',],
        '/6月/i' => ['June',],
        '/六月/i' => ['June',],
        '/jun/i' => ['June',],
        '/july/i' => ['July',],
        '/7月/i' => ['July',],
        '/七月/i' => ['July',],
        '/jul/i' => ['July',],
        '/august/i' => ['August',],
        '/8月/i' => ['August',],
        '/八月/i' => ['August',],
        '/aug/i' => ['August',],
        '/september/i' => ['September',],
        '/9月/i' => ['September',],
        '/九月/i' => ['September',],
        '/sep/i' => ['September',],
        '/october/i' => ['October',],
        '/10月/i' => ['October',],
        '/十月/i' => ['October',],
        '/oct/i' => ['October',],
        '/november/i' => ['November',],
        '/11月/i' => ['November',],
        '/十一月/i' => ['November',],
        '/nov/i' => ['November',],
        '/december/i' => ['December',],
        '/12月/i' => ['December',],
        '/十二月/i' => ['December',],
        '/dec/i' => ['December',],
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
         * @var $results \Xiaohuilam\LaravelTimePattern\Result\ResultObject[]
         */
        $results = [];
        foreach ($this->parterns as $regex => $matches_into) {
            preg_match($regex, $sentense, $ret);
            if (!count($ret)) {
                continue;
            } else {
                $mat = new ResultObject();
                $carbon = Carbon::parse($matches_into[0]);
                $mat->setFromMonth($carbon->copy()->firstOfMonth()->month);
                $mat->setToMonth($carbon->copy()->endOfMonth()->month);
                $mat->setFromDay($carbon->copy()->firstOfMonth()->day);
                $mat->setToDay( $carbon->copy()->endOfMonth()->day);
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
