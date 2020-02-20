<?php

include "config.php";

// execute student-collector.php first

$collector = new \Sponteweb\API\Collectors\StudentCollector();

echo "<h1>SEARCH INPUT</h1><pre>\n";
var_dump($studentCollectorSearch);
echo "\n</pre>\n";
echo "<h1>SEARCH RESULT</h1><pre>\n";
$result = $collector->searchOnCollection($studentCollectorSearch);
var_dump($result);
echo "\n</pre>";