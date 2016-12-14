<?php

namespace Core;

/**
 * Class Framework
 * @package Core
 */
/**
 * Class Framework
 * @package Core
 */
class Framework
{

    const DEFAULT_CONTROLLER = "Index";
    const DEFAULT_ACTION     = "indexAction";

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();

    /**
     * Framework constructor.
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    /**
     *
     */
    public function run()
    {
        $this->init();
        call_user_func_array(array(new $this->controller, $this->action), $this->params);

    }


    /**
     *
     */
    private function init()
    {
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);

        define("APP_PATH", ROOT . 'app' . DS);
        define("CORE_PATH", ROOT . "core" . DS);
        define("PUBLIC_PATH", ROOT . "public" . DS);
        define("CONFIG_PATH", ROOT . "config" . DS);
        define("LOG_PATH", ROOT . "logs" . DS);


        define("CONTROLLER_PATH", APP_PATH . "Controllers" . DS);
        define("MODEL_PATH", APP_PATH . "Models" . DS);
        define("VIEW_PATH", APP_PATH . "Views" . DS);


        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH);

        define("CURR_VIEW_PATH", VIEW_PATH);


        // Load configuration file

        $GLOBALS['config'] = include CONFIG_PATH . "config.php";


        // Start session

        session_start();

    }


    /**
     *
     */
    protected function parseUri()
    {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

        @list($controller, $action, $params) = explode("/", $path, 3);
        $controller =  ($controller == "")?self::DEFAULT_CONTROLLER:$controller;
        $action =  ($controller == "")?self::DEFAULT_ACTION:$action;
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }

    /**
     * @param $controller
     * @return $this
     */
    public function setController($controller)
    {
        spl_autoload_register();

        $controller = "App\\Controllers\\".ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException(
                "The action controller '$controller' has not been defined."
            );
        }
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param $action
     * @return $this
     */
    public function setAction($action)
    {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new \InvalidArgumentException(
                "The controller action '$action' has been not defined."
            );
        }
        $this->action = $action;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }
}
