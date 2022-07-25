<?php
namespace App\Controllers;

use Database\DBConnection;

abstract class Controller
{
    protected $db;

    public function __construct(DBConnection $db)
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $this->db = $db;
    }

    protected function view(string $path, array $params = null)
    {
        ob_start();
        $viewPath = str_replace('.',DIRECTORY_SEPARATOR,$path);
        require_once VIEWS_PATH.$viewPath.'.php';

        $content = ob_get_clean();
        require_once VIEWS_PATH.'layouts'.DIRECTORY_SEPARATOR.'base.php';
    }

    /**
     * @return DBConnection
     */
    protected function getDB(): DBConnection
    {
        return $this->db;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        if(isset($_SESSION['auth']) && $_SESSION['auth'] === 1){
            return true;
        }
        return  header("Location: /login");
    }
}