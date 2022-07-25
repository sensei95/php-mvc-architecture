<?php
namespace Router;

use App\Exceptions\NotFoundException;

class Router
{
    private string $url;
    private array $routes;

    public function __construct(string $url)
    {
        $this->url = trim($url,'/');
    }

    /**
     * @param string $path
     * @param string $action
     * @return void
     */
    public function get(string $path, string $action): void
    {
        $this->registerRoute($path,$action,'get');
    }

    /**
     * @param string $path
     * @param string $action
     * @return void
     */
    public function post(string $path, string $action): void
    {
        $this->registerRoute($path,$action,'post');
    }

    /**
     * @param string $path
     * @param string $action
     * @param string $method
     * @return Route
     */
    public function registerRoute(string $path, string $action, string $method = 'GET'): Route
    {
        return $this->routes[strtoupper($method)][] = new Route($path, $action);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run(): mixed
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->matches($this->url)){
                return $route->resolve();
            }
        }

        throw new NotFoundException("La page demandee est introuvable");
    }



}