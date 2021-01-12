<?php

class Router
{
    protected array $routes;
    public string $rootPath;
    public string $error404;

    /**
     * Router constructor.
     * Change it, if you need to change your project root directory.
     * @param string|null $rootPath
     * If you need to specify a 404 Page Handler, Default is (_404) in views/errors directory.
     * @param string $error404
     * If you already have an array with your exiting routes, you can easily import it here.
     * @param array $routes
     */
    public function __construct(string $rootPath = null, string $error404 = "errors/_404", array $routes = [])
    {
        $this->routes = $routes;
        $this->rootPath = $rootPath === null ? dirname(__DIR__) : $rootPath;
        $this->error404 = $error404;
    }

    public static function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public static function getRequest(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function get(string $path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    protected function renderView($view)
    {
        require $this->rootPath . "/views/$view.php";
    }

    public function resolve()
    {
        $method = $this->getMethod();
        $request = $this->getRequest();
        $callback = $this->routes[$method][$request] ?? false;
        if ($callback === false) {
            $this->setStatusCode(404);
            $this->renderView($this->error404);
            exit;
        }
        if (is_string($callback)) {
            $this->renderView($callback);
            exit;
        }
        return call_user_func($callback);
    }
}
