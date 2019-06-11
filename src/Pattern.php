<?php
namespace Xiaohuilam\LaravelTimePattern;

use Xiaohuilam\LaravelTimePattern\Rules\Interfaces\RuleInterface;
use Xiaohuilam\LaravelTimePattern\Result\ResultObject;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
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

    /**
     * 分词后分析
     *
     * @param string $sentense
     */
    public static function parse($sentense)
    {
        ini_set('memory_limit', -1);
        $t1 = microtime(true);
        Jieba::init(array('dict'=>'small'));
        //Finalseg::init();
        Posseg::init();
        $words = Posseg::cut($sentense);
        $result = [];
        foreach($words as $word) {
            //@TODO: 1月 2月 tag为m
            if (data_get($word, 'tag') != 't'){
                continue;
            }
            $string = $word['word'];
            $result[$string] = self::try($string);
        }
        return $result;
    }

    public static function try($sentense)
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
            $results = array_merge($results, $rule->try($sentense));
        }

        return $results;
    }
}