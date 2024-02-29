<?php
namespace App\Kernel\Models;
use App\Kernel\Database\Database;
use App\Kernel\Config\Config;

class Model {
    protected static string $table = 'products';
    protected array $attributes = [];

    public static function all()
    {
        return static::db()->all(static::$table);
    }

    public static function create($values):int|false
    {
        return static::db()->insert(static::$table, $values);
    }
    public static function get($conditions = [])
    {
        return static::db()->get(static::$table, $conditions);
    }
    public static function db():Database
    {
        return new Database(static::config());
    }
    public static function config():Config
    {
        return new Config();
    }
}