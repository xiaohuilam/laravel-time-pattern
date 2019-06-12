<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;

/**
 * 自定义分词 本地
 */
class CustomizeParticiple implements ParticipleInterface
{
    protected static $rules = [
        '/[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}20[\d]{2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2} [\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2} [\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/下下周/',
        '/下下礼拜/',
    ];

    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence)
    {
        $results = collect([]);
        foreach (self::$rules as $rule) {
            $matches = [];
            preg_match($rule, $sentence, $matches);
            if (count($matches) > 0) {
                foreach ($matches as $word) {
                    $results->push([
                        'tag' => 't',
                        'word' => $word
                    ]);
                }
            }
        }
        return $results;
    }
}
