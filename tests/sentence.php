<?php
use Xiaohuilam\LaravelTimePattern\Pattern;

require __DIR__ . '/../vendor/autoload.php';

dump(Pattern::parse('客户今天来了, 明天应该可以签合同'));
dump(Pattern::parse('我1月吃了1月饼'));
dump(Pattern::parse('我下周结婚了'));
