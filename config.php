<?
$dsn = 'mysql:host=localhost;dbname=shtrafy';
$username = 'root';
$password = '';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$DB = new PDO($dsn, $username, $password, $options);
?>