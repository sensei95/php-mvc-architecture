<?php
namespace Database;

use PDO;

class DBConnection
{
    private string $dbname;
    private string $host;
    private string $username;
    private string $password;

    private $pdo;

    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        if($this->pdo === null){
            try {
                $dsn = "mysql:dbname={$this->dbname}; host={$this->host}";
                $this->pdo = new PDO(
                    $dsn,
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    ]
                );

            }catch (\PDOException $exception){
                die($exception->getMessage());
            }
        }

        return $this->pdo;
    }
}