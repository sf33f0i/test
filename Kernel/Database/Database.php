<?php
namespace App\Kernel\Database;
use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface {
    private \PDO $pdo;
    public ConfigInterface $config;
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->connect();
    }

    private function connect():void
    {
        try{
        $host = $this->config->get('database.host');
        $dbname = $this->config->get('database.dbname');
        $login = $this->config->get('database.login');
        $password = $this->config->get('database.password');
        $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $login, $password);
        }catch(\PDOException $exception) {
            die("Не удалось подключиться к базе данных: ".$exception->getMessage());
        }
    }

    public function insert($table, $value):int|bool
    {
        $columns = array_keys($value);
        $attributes = implode(', ', array_map(fn ($column) =>":$column", $columns));
        $columns = implode(', ', $columns);
        $sql = "INSERT INTO $table ($columns) VALUE ($attributes)";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute($value);
        }catch (\PDOException $exception){
            return false;
        }
        return $this->pdo->lastInsertId();
    }

    public function first($table , array $fills = [])
    {
        $attribute = implode('AND', array_map(fn($fill)=> " $fill = :$fill ", array_keys($fills)));
        $sql = "SELECT * FROM $table WHERE $attribute LIMIT 1";
        $result = $this->pdo->prepare($sql);
        if(!$result->execute($fills)) return false;
        $result = $result->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}