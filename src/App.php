<?php

namespace Horoshop\Test;
use Horoshop\Test\src\Utils\MySQL;
/**
 * Class App
 */
class App
{
    /**
     * @var App
     */
    private static $instance;

    /**
     * @return App
     */
    public static function getInstance(): App
    {
        if (self::$instance === null) {
            return self::$instance = new static();

        }

        return self::$instance;
    }

    public function start(){
        MySQL::$pdo = new \PDO(
            "mysql:dbname=templates_db;host=localhost;charset=utf8",
            "root",
            ""
        );
        $this->route();
    }
    public function route()
    {

        $segments = explode('/', $this->getURI());

        //controller definition
        $controllerName = array_shift($segments);

        if (in_array($controllerName, ['', '/'])) {
            $controllerName = 'homepage';
        }

        $controllerName = ucfirst($controllerName . 'Controller');

        //action definition
        $actionName = array_shift($segments);

        if (in_array($actionName, ['', null])) {
            $actionName = 'index';
        }

        $actionName = 'action' . ucfirst($actionName);

        //parameters definition
        $parameters = $segments;


        $class = __NAMESPACE__ . '\\Controllers\\' . $controllerName;

        $controllerObject = new $class;
        $result           = call_user_func_array([$controllerObject, $actionName], $parameters);

        echo $result;
    }

    /**
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
}
