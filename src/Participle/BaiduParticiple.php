<?php
namespace Xiaohuilam\LaravelTimePattern\Participle;

use Xiaohuilam\LaravelTimePattern\Participle\Interfaces\ParticipleInterface;

/**
 * 百度分词 网络
 */
class BaiduParticiple implements ParticipleInterface
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
        $result = self::getClient()->depParser($sentence);
        if (!isset($result['items'])) {
            return;
        }
        return array_map(function ($item) {
            $item['tag'] = $item['postag'];
            return $item;
        }, $result['items']);
    }
}
