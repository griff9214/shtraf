<?
require_once 'classes.php';
require_once 'config.php';

$fineid = $_GET['fineid'];
$res = $DB->query("SELECT imgUrl FROM photos WHERE fineId = $fineid");
$response = $res->fetchAll(PDO::FETCH_COLUMN);
echo json_encode($response);
?>

