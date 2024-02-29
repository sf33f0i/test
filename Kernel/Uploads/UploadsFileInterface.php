<?php
namespace App\Kernel\Uploads;

interface UploadsFileInterface {

    public function move(string $path, string $FileName):string|false;

}