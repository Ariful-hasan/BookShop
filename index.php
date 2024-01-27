<?php
error_reporting(0);
require './src/bootstrap.php';
require_once 'config/config.php';
require_once 'config/helper.php';

use Src\Controllers\ImportController;
use Src\Controllers\SalesController;
use Src\Utils\Database;

/**
 * sales json import
 */
if ($_GET['type'] == 'import') {
    $import = new ImportController;
    $import();
}

$sales = new SalesController();
$sales->index();

Database::dbClose();
