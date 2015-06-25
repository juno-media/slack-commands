<?php

use Ddeboer\DataImport\Reader\ArrayReader;
use \Juno\Writer\ApiWriter;

use Juno\Handler;

ini_set("display_errors", true);

require_once __DIR__.'/../vendor/autoload.php';

$arrayReader = new ArrayReader(array(array(
    "token" => "CaPThDo9vZDst78EOQtFAXaY",
    "team_id" => "T02QS53DF",
    "team_domain" => "junomedia",
    "channel_id" => "D06L7KLCU",
    "channel_name" => "directmessage",
    "user_id" => "U06L7L5EV",
    "user_name" => "joeshiels",
    "command" => "/tracker",
    "text" => 'issue add junointernal "TEST TITLE 1" "sample glfdjfdlg dgf hdkfg"',
    //"text" => "login adamp-juno 1109900113ap",
)));

$arrayWriter = new ApiWriter();

$handler = new Handler($arrayReader, $arrayWriter);

$handler->run();