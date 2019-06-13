<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Posseg;
use Xiaohuilam\LaravelTimePattern\Statement\Statement;

/**
 * 结巴分词 本地
 */
class JiebaParticiple extends BaseParticiple implements ParticipleInterface
{
    protected static $init = false;

    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence)
    {
        ini_set('memory_limit', -1);
        if (!self::$init) {
            Jieba::init(array('dict' => 'small'));
            //Finalseg::init();
            Posseg::init();
            self::$init = true;
        }
        $result = Posseg::cut($sentence);

        return $result;
    }
}
