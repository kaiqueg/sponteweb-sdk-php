<?php

include "config.php";

// please run this file on terminal
$breakLine = "= = = = = = = = = =\n";
echo "STARTING COLLECTOR\n";
echo $breakLine;
$collector = new \Sponteweb\API\Collectors\StudentCollector();
$left = $collector->collect();
if (!$left) {
    echo "FINISHED\n";
    echo $breakLine;
} else {
    echo "$left LEFT\n";
    echo "{$collector->getLeftCallsCount()} CALLS LEFT\n";
    echo "{$collector->getCollectedPercentage()}% DONE\n";
    echo $breakLine;
}