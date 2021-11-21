<?php
namespace cursophp7dc\core;

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\AuthenticationException;
use cursophp7dc\app\exceptions\NotFoundException;

class Router
{
    private $routes;


    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }

    /**
     * @param string $file
     * @return Router
     */
    public static function load(string $file):Router
    {
        $router = new Router();
        require $file;
        return $router;
    }

    /**
     * @param string $uri
     * @param string $controller
     * @param string $role
     */
    public function get(string $uri, string $controller, $role='ROLE_ANONYMOUS'):void
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }

    /**
     * @param string $uri
     * @param string $controller
     * @param string $role
     */
    public function post(string $uri, string $controller, $role='ROLE_ANONYMOUS'):void
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }

    /**
     * @param string $controller
     * @param string $action
     * @param array $parameters
     * @return bool
     * @throws AppException
     * @throws NotFoundException
     */
    private function callAction(string $controller, string $action, array $parameters):bool
    {
        try {
            $controller = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
            $objController = new $controller();

            if (! method_exists($objController, $action))
                throw new NotFoundException("El controlador  $controller no responde al action $action");

            call_user_func_array(array($objController, $action), $parameters);

            return true;
        }
        catch (\TypeError $typeError)
        {
            return false;
        }
    }

    /**
     * @param string $uri
     * @param string $method
     * @throws AppException
     * @throws NotFoundException
     */
    public function direct(string $uri, string $method): void
    {
        foreach ($this->routes[$method] as $route=>$routeData)
        {
            $controller = $routeData['controller'];
            $minRole = $routeData['role'];

            $urlRule = $this->prepareRoute($route);

            if (preg_match($urlRule, $uri, $matches) === 1)
            {
                if (Security::isUserGranted($minRole) === false)
                {
                    if (!is_null(App::get('appUser')))
                        throw new AuthenticationException('Acceso no autorizado.');
                    else
                        $this->redirect('login');
                }
                {
                    $parameters = $this->getParametersRoute($route, $matches);

                    list($controller, $action) = explode ('@', $controller);

                    if ($this->callAction($controller, $action, $parameters) === true)
                        return;
                }
            }
        }

        throw new NotFoundException('No se ha definido una ruta para esta URI.');
    }

    /**
     * @param string $route
     * @return string
     */
    private function prepareRoute(string $route): string
    {
        $urlRule = preg_replace(
            '/:([^\/]+)/',
            '(?<\1>[^/]+)',
            $route
        );

        $urlRule = str_replace('/', '\/', $urlRule);

        return '/^' . $urlRule . '\/*$/s';
    }

    /**
     * @param string $route
     * @param array $matches
     * @return array
     */
    private function getParametersRoute(string $route, array $matches)
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);

        $parameterNames = array_flip($parameterNames[1]);

        return array_intersect_key($matches, $parameterNames);
    }

    public function redirect(string $path)
    {
        header('location: /' . $path);

        exit();
    }
}