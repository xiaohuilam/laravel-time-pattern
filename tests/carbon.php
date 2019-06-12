<?php
use Xiaohuilam\LaravelTimePattern\Date\Carbon;

require __DIR__ . '/boot.php';
$carbon = new Carbon();
$carbon->year = 2018;
dd($carbon->getSets());
