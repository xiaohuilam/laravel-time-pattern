<?php
namespace Xiaohuilam\LaravelTimePattern\Result\Traits;

use Xiaohuilam\LaravelTimePattern\Result\ResultObject;

trait FeatureTrait
{
    /**
     * 比较
     *
     * @return bool
     */
    public function isWideThan(ResultObject $resultObject)
    {
        /**
         * @var ResultObject $self
         */
        $self = $this;

        $thisFromYear = $self->getFromYear();
        $thisFromMonth = $self->getFromMonth();
        $thisFromDay = $self->getFromDay();
        $thisFromHour = $self->getFromHour();
        $thisFromMinute = $self->getFromMinute();
        $thisFromSecond = $self->getFromSecond();

        $thisToYear = $self->getToYear();
        $thisToMonth = $self->getToMonth();
        $thisToDay = $self->getToDay();
        $thisToHour = $self->getToHour();
        $thisToMinute = $self->getToMinute();
        $thisToSecond = $self->getToSecond();


        $otherFromYear = $resultObject->getFromYear();
        $otherFromMonth = $resultObject->getFromMonth();
        $otherFromDay = $resultObject->getFromDay();
        $otherFromHour = $resultObject->getFromHour();
        $otherFromMinute = $resultObject->getFromMinute();
        $otherFromSecond = $resultObject->getFromSecond();

        $otherToYear = $resultObject->getToYear();
        $otherToMonth = $resultObject->getToMonth();
        $otherToDay = $resultObject->getToDay();
        $otherToHour = $resultObject->getToHour();
        $otherToMinute = $resultObject->getToMinute();
        $otherToSecond = $resultObject->getToSecond();

        if ($thisFromYear && !$otherFromYear) {
            return false;
        } else {
            if ($thisFromYear && $otherFromYear) {
                if ($thisFromYear >= $otherFromYear) {
                    return false;
                } else {
                    if ($thisFromMonth && !$otherFromMonth) {
                        return false;
                    } else {
                        if ($thisFromMonth > $otherFromMonth) {
                            return false;
                        }
                        if ($thisFromDay && !$otherFromDay) {
                            return false;
                        } else {
                            if ($thisFromDay > $otherFromDay) {
                                return false;
                            } else {
                                if ($thisFromHour && !$otherFromHour) {
                                    return false;
                                } else {
                                    if ($thisFromHour > $otherFromHour) {
                                        return false;
                                    }
                                    if ($thisFromMinute && !$otherFromMinute) {
                                        return false;
                                    } else {
                                        if ($thisFromMinute > $otherFromMinute) {
                                            return false;
                                        }
                                        if ($thisFromSecond && !$otherFromSecond) {
                                            return false;
                                        } else {
                                            if ($thisFromSecond > $otherFromSecond) {
                                                return false;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        if ($thisToYear && !$otherToYear) {
            return false;
        } else {
            if ($thisToYear < $otherToYear) {
                return false;
            }
            if ($thisToMonth && !$otherToMonth) {
                return false;
            } else {
                if ($thisToMonth < $otherToMonth) {
                    return false;
                }
                if ($thisToDay && !$otherToDay) {
                    return false;
                } else {
                    if ($thisToDay < $otherToDay) {
                        return false;
                    }
                    if ($thisToHour && !$otherToHour) {
                        return false;
                    } else {
                        if ($thisToHour < $otherToHour) {
                            return false;
                        }
                        if ($thisToMinute && !$otherToMinute) {
                            return false;
                        } else {
                            if ($thisToMinute < $otherToMinute) {
                                return false;
                            }
                            if ($thisToSecond && !$otherToSecond) {
                                return false;
                            } else {
                                if ($thisToSecond < $otherToSecond) {
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }
}
