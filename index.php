<?
require_once 'vendor/autoload.php';
require_once 'classes.php';
require_once 'config.php';

$carlist = new DBCarList($DB);
$cars = $carlist->getCars();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Штрафы</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>
<body>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Марка авто</th>
        <th scope="col">ГРЗ</th>
        <th scope="col">№ СТС</th>
    </tr>
    </thead>
</table>

<? foreach ($cars as $car) {
    $res = $DB->query("SELECT * FROM fines WHERE car_id = {$car->id}");
    $fines = [];
    while ($fines[] = $res->fetchObject()) {
        $i++;
    }
    ?>
    <table class="table table-hover">
        <tbody>
        <tr role="button" data-toggle="collapse" data-target="#collapseExample<?= ++$n ?>" aria-expanded="true"
            aria-controls="collapseExample<?= $n ?>" style="cursor: pointer;">
            <td scope="row"><?= $n ?></td>
            <td scope="row"><?= "auto mark" ?></td>
            <td scope="row"><? echo "{$car->number} {$car->region}" ?></td>
            <td scope="row"><?= $car->stsNumber ?></td>
        </tr>
        </tbody>
    </table>
        <div class="collapse" id="collapseExample<?= $n ?>">
            <table class="table table-hover table-dark">
                <tbody>
                <? foreach ($fines as $fine) { ?>
                    <tr>
                        <td scope="row"><?= $fine->billId ?></td>
                        <td scope="row"><?= $fine->sum ?></td>
                        <td scope="row"><?= $fine->fineDate ?></td>
                        <td scope="row"><?= $fine->parseDate ?></td>
                        <td scope="row"><?= $fine->koapText ?></td>
                    </tr>
                <? } ?>
                </tbody>

            </table>
        </div>
<? } ?>
</body>
</html>