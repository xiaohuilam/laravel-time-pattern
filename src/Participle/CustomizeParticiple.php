<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;
use Xiaohuilam\LaravelTimePattern\Statement\Statement;

/**
 * 自定义分词 本地
 */
class CustomizeParticiple extends BaseParticiple implements ParticipleInterface
{
    const SPLIT = '#<!----';

    protected static $rules =[
        // YYYY/mm/dd-YYYY/mm/dd
        '/([\d]{4})[\W\:^\ ^-]([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})\-([\d]{4})[\W\:^\ ^-]([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})/',
        // mm/dd-mm/dd
        '/([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})\-([\d]{1,2})[\W\:^\ ^-]([\d]{1,2})/',
        // YYYY.mm
        '/([\d]{4})[\W\:^\ ]([\d]{1,2})/',
        // YYYY年mm月
        '/([\d]{4})年([\d]{1,2})(月|月前)/',
        // YYYY年mm月dd日
        '/([\d]{4})年([\d]{1,2})月([\d]{1,2})(日|日前)/',
        // dd号
        '/([\d]{1,2}),([\d]{1,2})(号|日)/',
        '/([\d]{1,2})号/',
        '/[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}20[\d]{2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2} [\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/20[\d]{2}[\W^\:^\ ]{1,4}[\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2} [\d]{1,2}[\W^\:^\ ]{1,4}[\d]{1,2}/',
        '/下个月/',
        '/下下周/',
        '/下下礼拜/',
        '/[一二三四五六七八九十]{1,6}月[一二三四五六七八九十]{1,6}(日|号)(早晨|早上|上午|中午|晌午|下午|傍晚|夜晚|晚上|深夜|子夜|凌晨|清晨)[一二三四五六七八九十]{1,6}点/',
        '/[一二三四五六七八九十]{1,6}月[一二三四五六七八九十]{1,6}(日|号)(早晨|早上|上午|中午|晌午|下午|傍晚|夜晚|晚上|深夜|子夜|凌晨|清晨)/',
        '/[一二三四五六七八九十]{1,6}月[一二三四五六七八九十]{1,6}(日|号)/',
        '/[一二三四五六七八九十]{1,6}(日|号)(早晨|早上|上午|中午|晌午|下午|傍晚|夜晚|晚上|深夜|子夜|凌晨|清晨)[一二三四五六七八九十]{1,6}点/',
        '/[一二三四五六七八九十]{1,6}(日|号)(早晨|早上|上午|中午|晌午|下午|傍晚|夜晚|晚上|深夜|子夜|凌晨|清晨)/',
        '/[一二三四五六七八九十]{1,6}(日|号)/',
        '/(这|过)(两|三|四|五|六|七|几|些)天/',
        // mm.dd
        '/([\d]{1,2})[\W\:^\ ]([\d]{1,2})/',
    ];

    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence)
    {
        $sentence = preg_replace('/[ ]{2,}/', ' ', $sentence);

        $results = collect([]);
        $rules = collect(self::$rules)->flip()->map(function ($nulled, $rule) {
            return function ($a) {
                return self::SPLIT . base64_encode($a[0]) . self::SPLIT;
            };
        })->toArray();
        foreach ($rules as $rule => $callback) {
            $sentence = preg_replace_callback($rule, $callback, $sentence);
        }

        $results = explode(self::SPLIT, $sentence);
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

        dd($results);
        return $results;
    }
}
