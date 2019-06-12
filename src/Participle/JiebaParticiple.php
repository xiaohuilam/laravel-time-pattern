<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;

/**
 * 结巴分词 本地
 */
class JiebaParticiple extends BaseParticiple implements ParticipleInterface
{
    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence)
    {
        ini_set('memory_limit', -1);
        Jieba::init(array('dict' => 'small'));
        //Finalseg::init();
        Posseg::init();
        return Posseg::cut($sentence);
    }
}
