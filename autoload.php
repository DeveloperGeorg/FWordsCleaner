<?php

use Symfony\Component\Dotenv\Dotenv;

$composerAutoload = [
    __DIR__ . '/vendor/autoload.php', // standalone with "composer install" run
    __DIR__ . '/../../autoload.php',  // script is installed as a composer binary
];
foreach ($composerAutoload as $autoload) {
    if (file_exists($autoload)) {
        require($autoload);
        break;
    }
}

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
