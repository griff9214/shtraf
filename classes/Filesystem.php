<?php
/**
 * Created by PhpStorm.
 * User: Григорий
 * Date: 18.03.2019
 * Time: 20:29
 */

namespace classes;


class Filesystem
{
    private $currentDir;

    public function __construct($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $this->currentDir = $dir;
    }

    public function createDir($dir): bool
    {
        if (!is_dir("{$this->currentDir}/$dir")) {
            return mkdir("{$this->currentDir}/$dir");
        } else {
            return true;
        }
    }

    public function setCurrentDir($dir)
    {
        $this->currentDir = "{$this->currentDir}/$dir";
    }

    public function savePhoto($name, $photo)
    {
        file_put_contents("{$this->currentDir}/$name", $photo);
    }
}