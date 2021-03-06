<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'think\\migration\\' => array($vendorDir . '/topthink/think-migration/src'),
    'think\\helper\\' => array($vendorDir . '/topthink/think-helper/src'),
    'think\\composer\\' => array($vendorDir . '/topthink/think-installer/src'),
    'think\\captcha\\' => array($vendorDir . '/topthink/think-captcha/src'),
    'think\\' => array($baseDir . '/thinkphp/library/think', $vendorDir . '/topthink/think-queue/src', $vendorDir . '/topthink/think-image/src'),
    'cms\\composer\\' => array($vendorDir . '/newday-me/think-cms-installer/src'),
    'cms\\' => array($baseDir . '/thinkcms/library'),
    'Upyun\\' => array($vendorDir . '/upyun/sdk/src/Upyun'),
    'Qiniu\\' => array($vendorDir . '/qiniu/php-sdk/src/Qiniu'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'Phinx\\' => array($vendorDir . '/topthink/think-migration/phinx/src/Phinx'),
    'Mimey\\' => array($vendorDir . '/ralouphie/mimey/src'),
    'MatthiasMullie\\PathConverter\\' => array($vendorDir . '/matthiasmullie/path-converter/src'),
    'MatthiasMullie\\Minify\\' => array($vendorDir . '/matthiasmullie/minify/src'),
    'Ifsnop\\' => array($vendorDir . '/ifsnop/mysqldump-php/src/Ifsnop'),
    'GuzzleHttp\\Psr7\\' => array($vendorDir . '/guzzlehttp/psr7/src'),
    'GuzzleHttp\\Promise\\' => array($vendorDir . '/guzzlehttp/promises/src'),
    'GuzzleHttp\\' => array($vendorDir . '/guzzlehttp/guzzle/src'),
);
