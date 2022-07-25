<?php
namespace Router;

use Database\DBConnection;

class Route
{
    private string $path;
    private string $action;
    public array $matches;

    /**
     * @param string $path
     * @param string $action
     */
    public function __construct(string $path, string $action)
    {
        $this->path = trim($path,'/');
        $this->action = $action;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function matches(string $url): bool
    {
        $path = preg_replace("#:([\w]+)#","([^/]+)",$this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            return true;
        }

        return  false;
    }

    /**
     * @return mixed
     */
    public function resolve(): mixed
    {
        $params = explode('@', string: $this->action);
        $controller = new $params[0](new DBConnection(DB_NAME,DB_HOST,DB_USER,DB_PASSWORD));

        $method = $params[1];

        if(isset($this->matches, $this->matches[1])){
            return $controller->$method($this->matches[1]);
        }
        return $controller->$method();
    }
}