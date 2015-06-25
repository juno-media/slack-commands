<?php

use Ddeboer\DataImport\Reader\ArrayReader;
use \Juno\Writer\ApiWriter;

use Juno\Handler;

ini_set("display_errors", true);

require_once __DIR__.'/vendor/autoload.php';

if (isset($_POST)) {
    $data = array($_POST);
}

$arrayReader = new ArrayReader($data);

$arrayWriter = new ApiWriter();

$handler = new Handler($arrayReader, $arrayWriter);

$handler->run();