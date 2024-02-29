<?php
namespace App\Kernel\Uploads;

class UploadsFile implements UploadsFileInterface {
    public function __construct(
        private string $name,
        private string $full_path,
        private string $type,
        private string $tmp_name,
        private string $error,
        private string $size,
    )
    {}

    public function move(string $path, string $FileName = null):string|false
    {
        $storage = APP_PATH."/storage/$path";
        if(!is_dir($storage)){
            mkdir($storage, 0777, true);
        }
        $FileName = $FileName?? $this->randomName();
        $storage = "$storage/$FileName";
        if(move_uploaded_file($this->tmp_name, $storage)){
            return "/storage/$path/$FileName";
        }
        return false;
    }

    public function randomName(){
        return md5(uniqid()).'.'.$this->path();
    }
    public function path()
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }
}