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
        $this->currentDir = $this->refactorPath($dir);
    }

    public function createDir($dir): bool
    {
        if (is_dir("{$this->currentDir}/$dir")) {
            return true;
        }
        return mkdir("{$this->currentDir}/$dir");

    }

    public function setCurrentDir($dir)
    {
        $this->currentDir = "$this->currentDir/$dir";
    }

    public function savePhoto($name, $photo)
    {
        file_put_contents("{$this->currentDir}/$name", $photo);
    }

    public function levelUp()
    {
        $this->currentDir = rtrim($this->currentDir, "\//");
        $this->currentDir = substr($this->currentDir, 0, strrpos($this->currentDir, '/'));
    }

    /**
     * @return string
     */
    public function getCurrentDir(): string
    {
        return $this->currentDir;
    }

    public function makePhotoUrl($name)
    {
        return str_replace($this->refactorPath(Config::ROOT_DIR), "", $this->currentDir) . "/" . $name;
    }

    private function refactorPath($path)
    {
        return rtrim(str_replace('\\', '/', $path), '\\\/ ');
    }
}