<?php
use Xiaohuilam\LaravelTimePattern\Pattern;

require __DIR__ . '/../vendor/autoload.php';

dump(Pattern::parse('我一月吃了一月饼'));
dump(Pattern::parse('我一月份吃了一月饼'));
dump(Pattern::parse('客户今天来了, 明天应该可以签合同'));
dump(Pattern::parse('我下周结婚了'));
dump(Pattern::parse('明年我还能遇见你么?'));
dump(Pattern::parse('二月春风似剪刀'));
