<?php
use Xiaohuilam\LaravelTimePattern\Partern;

require __DIR__ . '/../vendor/autoload.php';

dump(Partern::try('今天'));
dump(Partern::try('今天下午'));
dump(Partern::try('明天'));
dump(Partern::try('后天'));
dump(Partern::try('昨天'));
dump(Partern::try('今年'));
dump(Partern::try('这个月'));
dump(Partern::try('本月'));
dump(Partern::try('月初'));
dump(Partern::try('月底'));
dd(Partern::try('上旬'));
dump(Partern::try('下旬'));
dump(Partern::try('一月'));
dump(Partern::try('二月'));
dump(Partern::try('三月'));
dump(Partern::try('四月'));

dump(Partern::try('1月'));
dump(Partern::try('2月'));
dump(Partern::try('3月'));
dump(Partern::try('4月'));

dump(Partern::try('2019/01/01 11:22:33'));
dump(Partern::try('2019-01-01 11:22:33'));
dump(Partern::try('01/01/2019 11:22:33'));
dump(Partern::try('01-01-2019 11:22:33'));
dump(Partern::try('2019-01-01 11:22'));
dump(Partern::try('2019-01-01'));
dump(Partern::try('01-01-2019'));
dump(Partern::try('01/01/2019'));
dump(Partern::try('01/01/2019'));
dump(Partern::try('next mon'));
dump(Partern::try('jan'));
dump(Partern::try('april'));
dump(Partern::try('April'));
