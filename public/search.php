<?php
require __DIR__ . '/../vendor/autoload.php';

$minmagnitude = $_GET['minmagnitude'];
$starttime = $_GET['starttime'];
$endtime = $_GET['endtime'];

try {
    $result = \App\Usgs\Request\Services::featureCollection($minmagnitude, $starttime, $endtime);
    response_json($result);
}
catch (\Exception $e) {
    response_json($e);
}

