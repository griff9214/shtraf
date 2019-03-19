<?
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use classes\Config;
use classes\Filesystem;

$fileSys = new Filesystem(Config::FINES_DIR);

$fileSys->createDir("Р343ОХ");
$fileSys->setCurrentDir("Р343ОХ");

$fileSys->createDir("54654654654");
$fileSys->setCurrentDir("54654654654");
$fileSys->levelUp();
$fileSys->levelUp();
