<?
require_once 'vendor/autoload.php';
require_once 'classes.php';
require_once 'config.php';


$q = $DB->prepare('SELECT * FROM fines WHERE car_id = 3 LIMIT 1');
$q->execute();
$a = $q->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Fine");
var_dump($a);
?>