<?php

$composerAutoloader = require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
/* @var $composerAutoloader \Composer\Autoload\ClassLoader */
$composerAutoloader->add('Potaka', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src');
