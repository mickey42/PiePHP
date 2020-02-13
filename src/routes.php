<?php
namespace Core;
$url_parts = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);
$last_part = $url_parts[count($url_parts)-1];
$id = (preg_match('/[0-9]+/', $last_part)) ? $last_part : null;



Router::connect('/PiePHP/', ['controller' => 'user', 'action' => 'register']);
Router::connect('/PiePHP/index.php', ['controller' => 'user', 'action' => 'login']);
Router::connect('/PiePHP/index.php/register', ['controller' => 'user', 'action' => 'add']);
Router::connect('/PiePHP/index.php/user/register', ['controller' => 'user', 'action' => 'register']);
Router::connect('/PiePHP/index.php/user', ['controller' => 'user', 'action' => 'index']);
Router::connect('/PiePHP/index.php/user/add', ['controller' => 'user', 'action' => 'add']);
Router::connect('/PiePHP/index.php/user/register', ['controller' => 'user', 'action' => 'register']);
Router::connect('/PiePHP/index.php/user/login', ['controller' => 'user', 'action' => 'login']);
Router::connect('/PiePHP/index.php/user/show', ['controller' => 'user', 'action' => 'show']);
Router::connect('/PiePHP/index.php/user/logout', ['controller' => 'user', 'action' => 'logout']);
Router::connect('/PiePHP/index.php/film/show', ['controller' => 'film', 'action' => 'show']);
Router::connect("/PiePHP/index.php/film/show/$id", ['controller' => 'film', 'action' => 'show']);
Router::connect("/PiePHP/index.php/film/add", ['controller' => 'film', 'action' => 'add']);
Router::connect("/PiePHP/index.php/genre/show", ['controller' => 'genre', 'action' => 'show']);
Router::connect("/PiePHP/index.php/film/addhsitorique/$id", ['controller' => 'film', 'action' => 'addhsitorique']);
Router::connect("/PiePHP/index.php/film/delhsitorique/$id", ['controller' => 'film', 'action' => 'delhsitorique']);
Router::connect("/PiePHP/index.php/film/historique", ['controller' => 'film', 'action' => 'readhistorique']);

Router::connect("/PiePHP/index.php/if/logre", ['controller' => 'app', 'action' => 'ogre']);

Router::connect("/PiePHP/index.php/film/test", ['controller' => 'film', 'action' => 'test']);

Router::connect("/PiePHP/index.php/user/boris", ['controller' => 'user', 'action' => 'boris']);
