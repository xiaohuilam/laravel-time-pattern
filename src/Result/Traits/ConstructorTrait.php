<?php
namespace Xiaohuilam\LaravelTimePattern\Result\Traits;

use Xiaohuilam\LaravelTimePattern\Date\Carbon;

trait ConstructorTrait
{
    /**
     * @var Carbon
     */
    public $from;

    /**
     * @var Carbon
     */
    public $to;

    /**
     * 构造
     *
     * @param Carbon $from
     * @param Carbon $to
     */
    public function __construct($from = null, $to = null)
    {
        $this->setFromCarbon($from);
        $this->setToCarbon($to);
    }


    /**
     * 设置开始时间
     *
     * @param Carbon $carbon
     * @return ConstructorTrait|\Xiaohuilam\LaravelTimePattern\Result\ResultObject
     */
    protected function setFromCarbon($carbon, $action = 'From')
    {
        $this->{strtolower($action)} = $carbon;
        foreach ($carbon->getSets() as $set) {
            $method = 'set' . $action . ucfirst($set);
            $this->{$method}($carbon->{$set});
        }
        return $this;
    }

    /**
     * 设置开始时间
     *
     * @param \Carbon\Carbon $carbon
     * @return ConstructorTrait|\Xiaohuilam\LaravelTimePattern\Result\ResultObject
     */
    protected function setToCarbon($carbon, $action = 'To')
    {
        $this->{strtolower($action)} = $carbon;
        foreach ($carbon->getSets() as $set) {
            $method = 'set' . $action . ucfirst($set);
            $this->{$method}($carbon->{$set});
        }
        return $this;
    }
}
