<?php

$baseConfig = include ('../configs/base.config.php');

return array_merge(
    $baseConfig,
    [
        'db' => [
            'KomisjaWyborcza' => [
                'driver' => 'Mysqli',
                'dbname' => 'KomisjaWyborcza',
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