<?
namespace classes;
use PDO;

$dsn = 'mysql:host=localhost;dbname=shtrafy';
$username = 'root';
$password = '';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$DB = new PDO($dsn, $username, $password, $options);
class Config {
    const USE_PROXY = true;
    const HTTP_PROXY = "127.0.0.1:8888";
    const HTTPS_PROXY = "127.0.0.1:8888";

    public static $headers = [
            'Host' => 'shtrafyonline.ru',
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,image/*,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        ];

}
?>