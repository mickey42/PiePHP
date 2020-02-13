<?php
define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core();


$app->run();

//define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']))
?>


