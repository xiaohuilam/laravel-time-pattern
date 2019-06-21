<?php
use Xiaohuilam\LaravelTimePattern\Pattern;

require __DIR__ . '/boot.php';

dump(Pattern::parse('2017/07/11-2019/08/01'));
dump(Pattern::parse('07/11-08/01'));
dump(Pattern::parse('12/1'));
dump(Pattern::parse('下周'));
dump(Pattern::parse('今天'));
dump(Pattern::parse('今天下午'));
dump(Pattern::parse('明天'));
dump(Pattern::parse('后天'));
dump(Pattern::parse('昨天'));
dump(Pattern::parse('今年'));
dump(Pattern::parse('这个月'));
dump(Pattern::parse('本月'));
dump(Pattern::parse('月初'));
dump(Pattern::parse('月底'));
dump(Pattern::parse('上旬'));
dump(Pattern::parse('下旬'));
dump(Pattern::parse('一月'));
dump(Pattern::parse('二月'));
dump(Pattern::parse('三月'));
dump(Pattern::parse('四月'));

dump(Pattern::parse('1月'));
dump(Pattern::parse('2月'));
dump(Pattern::parse('3月'));
dump(Pattern::parse('4月'));

dump(Pattern::parse('2019/01/01 11:22:33'));
dump(Pattern::parse('2019-01-01 11:22:33'));
dump(Pattern::parse('01/01/2019 11:22:33'));
dump(Pattern::parse('01-01-2019 11:22:33'));
dump(Pattern::parse('2019-01-01 11:22'));
dump(Pattern::parse('2019-01-01'));
dump(Pattern::parse('01-01-2019'));
dump(Pattern::parse('01/01/2019'));
dump(Pattern::parse('01/01/2019'));
dump(Pattern::parse('next mon'));
dump(Pattern::parse('jan'));
dump(Pattern::parse('april'));
dump(Pattern::parse('April'));
