<?php
use Xiaohuilam\LaravelTimePattern\Pattern;

require __DIR__ . '/boot.php';

dump(Pattern::try('今天'));
dump(Pattern::try('今天下午'));
dump(Pattern::try('明天'));
dump(Pattern::try('后天'));
dump(Pattern::try('昨天'));
dump(Pattern::try('今年'));
dump(Pattern::try('这个月'));
dump(Pattern::try('本月'));
dump(Pattern::try('月初'));
dump(Pattern::try('月底'));
dump(Pattern::try('上旬'));
dump(Pattern::try('下旬'));
dump(Pattern::try('一月'));
dump(Pattern::try('二月'));
dump(Pattern::try('三月'));
dump(Pattern::try('四月'));

dump(Pattern::try('1月'));
dump(Pattern::try('2月'));
dump(Pattern::try('3月'));
dump(Pattern::try('4月'));

dump(Pattern::try('2019/01/01 11:22:33'));
dump(Pattern::try('2019-01-01 11:22:33'));
dump(Pattern::try('01/01/2019 11:22:33'));
dump(Pattern::try('01-01-2019 11:22:33'));
dump(Pattern::try('2019-01-01 11:22'));
dump(Pattern::try('2019-01-01'));
dump(Pattern::try('01-01-2019'));
dump(Pattern::try('01/01/2019'));
dump(Pattern::try('01/01/2019'));
dump(Pattern::try('next mon'));
dump(Pattern::try('jan'));
dump(Pattern::try('april'));
dump(Pattern::try('April'));
