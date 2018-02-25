<?php

$baseConfig = include ('../configs/base.config.php');

return array_merge(
    $baseConfig,
    [
        'homeURL' => 'http://agencjauprawnien.oo',
        'KomisjaWyborczaURL' => 'http://komisjawyborcza.oo',
        'db' => [
            'AgencjaUprawnien' => [
                'driver' => 'Mysqli',
                'dbname' => 'AgencjaUprawnien',
                'username' => 'root',
                'password' => 'rootroot'
            ]
        ],
        'smarty' => [
            //debugging = true;
            'caching' => true,
            'cache_lifetime' => 0,
            'cache_dir' => '../cache/Smarty/cache',
            'compile_dir' => '../cache/Smarty/templates_c',
        ]
    ]
);