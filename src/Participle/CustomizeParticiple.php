<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;

/**
 * 自定义分词 本地
 */
class CustomizeParticiple extends BaseParticiple implements ParticipleInterface
{
    const SPLIT = '#<!----';

    protected static $rules =[
        // YYYY.mm
        '/([\d]{4})[\W\:^\ ]([\d]{1,2})/',
        // YYYY年mm月
        '/([\d]{4})年([\d]{1,2})月/',
        // YYYY年mm月dd日
        '/([\d]{4})年([\d]{1,2})月([\d]{1,2})日/',
        // dd号
        '/([\d]{1,2})号/',
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
        $rules = collect(self::$rules)->flip()->map(function ($nulled, $rule) {
            return function ($a) {
                return self::SPLIT . base64_encode($a[0]) . self::SPLIT;
            };
        })->toArray();
        $result = preg_replace_callback_array($rules, $sentence, -1);
        $results = explode(self::SPLIT, $result);
        $results = collect($results)->map(function ($word) {
            $decoded = base64_decode($word);
            if (!$decoded) {
                return [
                    'word' => $word,
                    'tag' => 'x',
                ];
            }

            return [
                'word' => $decoded,
                'tag' => 't',
            ];
        });

        return $results->toArray();
    }
}
