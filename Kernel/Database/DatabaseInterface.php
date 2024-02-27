<?php
namespace App\Kernel\Database;

interface DatabaseInterface {

    public function insert($table, $value);

}