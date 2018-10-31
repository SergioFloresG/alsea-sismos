<?php

require __DIR__ . '/../vendor/autoload.php';

$blade = new \Jenssegers\Blade\Blade(
    [__DIR__ . '/../resources/views'],
    __DIR__ . '/../resources/cache'
);
echo $blade->render('home', ['sismos' => []]);