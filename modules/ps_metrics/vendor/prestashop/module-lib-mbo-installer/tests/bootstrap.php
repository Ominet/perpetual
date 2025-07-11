<?php

namespace ps_metrics_module_v4_1_2;

if (!\getenv('_PS_ROOT_DIR_')) {
    echo "[ERROR] Define _PS_ROOT_DIR_ with the path to PrestaShop folder\n";
    exit(1);
}
if (!\defined('_PS_ADMIN_DIR_')) {
    \define('_PS_ADMIN_DIR_', '/admin');
}
if (!\defined('_PS_MODE_DEV_')) {
    \define('_PS_MODE_DEV_', \true);
}
$rootDirectory = \getenv('_PS_ROOT_DIR_');
$projectDir = __DIR__ . '/../';
require_once $rootDirectory . '/config/config.inc.php';
require_once $projectDir . 'vendor/autoload.php';
global $kernel;
if (!$kernel) {
    require_once \_PS_ROOT_DIR_ . '/app/AppKernel.php';
    $kernel = new AppKernel('dev', \true);
    $kernel->boot();
}
