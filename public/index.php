<?php

use App\core\App;
use App\services\renderers\TwigRenderer;

include dirname(__DIR__) . "/vendor/autoload.php";
$config = include dirname(__DIR__) . "/config/main.php";

(new App())->run($config);




