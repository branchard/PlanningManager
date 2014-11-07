<?php
session_start();
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require(ROOT . 'core/configure.php');
require(ROOT . 'core/database.php');
require(ROOT . 'core/connect.php');
require(ROOT . 'core/model.php');
require(ROOT . 'core/controller.php');

$connectionObj = new connect();
$connection = $connectionObj->getConnection();
model::setConnection($connection);

$params = explode('/', $_GET['p']);
if ($params[0] == '')
{
    $params[0] = 'welcome';
}
$controller = $params[0];
$action = isset($params[1]) ? $params[1] : 'index';
if (file_exists(ROOT . 'controllers/' . $controller . '.php') && is_readable(ROOT . 'controllers/' . $controller . '.php'))
{
    require(ROOT . 'controllers/' . $controller . '.php');

    $controller = new $controller();

    if (method_exists($controller, $action))
    {
        unset($params[0]);
        unset($params[1]);
        call_user_func_array(array($controller, $action), $params);
        //$controller->$action();
    }
    else
    {
        echo 'erreur 404';// il faudrait inclure un fichier d'erreur 404
    }
}
else
{
    echo 'erreur 404';// il faudrait inclure un fichier d'erreur 404
}

?>