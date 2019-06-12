<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;

/**
 * 百度分词 网络
 */
class BaiduParticiple extends BaseParticiple implements ParticipleInterface
{
    protected static function getConfig($name)
    {
        return config('nlp_time_pattern.baidu.' . $name);
    }

    /**
     * 获取client
     *
     * @return \AipNlp
     */
    protected static function getClient()
    {
        $client = new \AipNlp(self::getConfig('appid'), self::getConfig('appkey'), self::getConfig('appsecret'));
        return $client;
    }

    /**
     * 分词方法
     *
     * @param string $sentence
     * @return void
     */
    public static function parts($sentence)
    {
        $depParser = self::getClient()->depParser($sentence);
        $lexer = self::getClient()->lexer($sentence);
        $result = collect([]);

        if (isset($depParser['items'])) {
            $result = $result->merge(array_map(function ($item) {
                $item['tag'] = $item['postag'];
                return $item;
            }, $depParser['items']));
        }
        if (isset($lexer['items'])) {
            $result = $result->merge(collect($lexer['items'])->where('ne', 'TIME')->values()->map(function ($item) {
                $item['word'] = $item['item'];
                $item['tag'] = 't';
                return $item;
            }));
        }
        return $result;
    }
}
