<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;

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
    ];

    protected static function prepare($sentence)
    {
        $sentence = preg_replace_callback('/([\d]+)[\ ]{0,}(月|年|天|小时|分钟|秒钟|秒)/', function($match) {
            $map = [
                1 => '一',
                2 => '二',
                3 => '三',
                4 => '四',
                5 => '五',
                6 => '六',
                7 => '七',
                8 => '八',
                9 => '九',
                10 => '十',
                11 => '十一',
                12 => '十二',
            ];
            return data_get($map, $match[1], $match[1]) . $match[2];
        }, $sentence);
        return $sentence;
    }

    /**
     * 分词后分析
     *
     * @param string $sentence
     */
    public static function parse($sentence)
    {
        ini_set('memory_limit', -1);
        Jieba::init(array('dict'=>'small'));
        //Finalseg::init();
        Posseg::init();
        $sentence = self::prepare($sentence);
        $words = Posseg::cut($sentence);
        $stacks = [];

        foreach($words as $word) {
            $need_parse = false;
            //@TODO: 1月 2月 tag为m
            if (data_get($word, 'tag') == 't'){
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
