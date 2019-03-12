<?
require_once 'config.php';

$fineid = $_GET['fineid'];
$res = $DB->query("SELECT imgUrl FROM photos WHERE fineId = $fineid");
$response = $res->fetchAll(PDO::FETCH_COLUMN);
if ($response != false) {
    echo json_encode($response);
} else {
    echo json_encode([
        'error' => 'не могу загрузить фото из БД',
    ]);
}
?>

