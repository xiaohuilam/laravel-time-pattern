<?php
namespace Xiaohuilam\LaravelTimePattern\Rules;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Illuminate\Support\Carbon;

class SubDayRule
{
    /**
     * 顺序敏感
     * *. 在本规则（其他规则不搭界）中，['为日期范围', '月份指定可空']
     *
     * @var array
     */
    protected $parterns = [
        '/早上/i' => ['6-9'],
        '/morning/i' => ['6-9'],
        '/上午/i' => ['8-11'],
        '/中午/i' => ['11-13'],
        '/晌午/i' => ['11-13'],
        '/下午/i' => ['13-17'],
        '/afternoon/i' => ['13-17'],
        '/noon/i' => ['11-13'],
        '/晚上/i' => ['17-22'],
        '/今晚/i' => ['17-22'],
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

        '/昨晚/i' => ['17-22', '-1 days'],
        '/last night/i' => ['17-22', '-1 days'],
        '/yesterday night/i' => ['17-22', '-1 days'],

        '/昨早/i' => ['6-9', '-1 days'],
        '/last morning/i' => ['6-9', '-1 days'],
        '/yesterday morning/i' => ['6-9', '-1 days'],

        '/明晚/i' => ['17-22', '+1 days'],
        '/tomorrow night/i' => ['17-22', '+1 days'],
        '/next night/i' => ['17-22', '+1 days'],
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
                $carbon = Carbon::now();
                list($from, $to) = explode('-', $matches_into[0]);
                if (isset($matches_into[1])) {
                    $carbon->setfrom($matches_into[1]);
                }

                $mat->setFromCarbon($carbon->copy()->setDay($from));
                $mat->setToCarbon($carbon->copy()->setDay($to));
                $results = array_merge($results, [$mat]);
                return $results;
            }
        }
        return $results;
    }
}
