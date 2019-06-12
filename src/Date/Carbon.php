<?php
namespace Xiaohuilam\LaravelTimePattern\Date;

/**
 * 魔改 Carbon 类
 * 因为 Carbon 会自动设置年月日时分秒，所以实现单独记录设置的功能，但沿用这套机制
 */
class Carbon extends \Carbon\Carbon
{
    protected $sets = [];

    public function set($name, $value = NULL)
    {
        $this->sets[] = $name;
        if (method_exists(parent::class, 'set')) {
            parent::set($name, $value);
        }
        return $this;
    }

    public function getSets()
    {
        return collect($this->sets)->unique()->toArray();
    }
}
