<?php

require_once realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "vendor", "autoload.php"]));
require_once realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "src", "spl_autoload.php"]));

\Sponteweb\API\Settings::setApiKey("YOUR-API-KEY");

$studentCollectorSearch = [];