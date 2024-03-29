<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Statement\Statement;

/**
 * 分词
 *
 * @mixin \Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface
 * @see \Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface
 * @method static array parts($sentence)
 */
abstract class BaseParticiple
{
    /**
     * 运行
     *
     * @param string $sentence
     * @return array
     */
    public static function run($sentence)
    {
        return static::union(static::parts($sentence));
    }

    /**
     * 分词聚集算法，将`tag` = `t`的，相邻的词，聚集到一起
     *
     * @param array $words
     * @return array
     */
    public static function union($words)
    {
        $words = collect($words)->toArray();
        foreach ($words as $key => &$word) {
            for ($i = 1; $i < 10; $i++) {
                if ($word['tag'] != 't' || !isset($words[$key + $i])) {
                    break;
                }

                $word_i = &$words[$key + $i];
                if ($word_i['tag'] != 't') {
                    break;
                }

                $word['word'] .= $word_i['word'];
                $word_i['word'] = '';
                unset($words[$key + $i]);
            }
        }

        return collect($words)->map(function ($item) {
            return new Statement($item);
        });
    }
}
