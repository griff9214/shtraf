<?

use classes\DBCarList;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        <th scope="col" colspan="2">№ СТС</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($cars as $car) {
        $fines = $carlist->getAllFines($car);
        $finesCount = $carlist->getFinesCount($car);
        $finesCounter = 0;
        ?>

        <tr role="button" data-toggle="collapse" data-target="#collapseExample<?= $car->id ?>" aria-expanded="true"
            aria-controls="collapseExample<?= $car->id ?>" style="cursor: pointer;">
            <td scope="row"><?= $car->id ?></span></td>
            <td scope="row"><?= "auto mark" ?></td>
            <td scope="row"><? echo "{$car->number} {$car->region}" ?></td>
            <td scope="row"><?= $car->stsNumber ?></td>
            <td scope="row" style="text-align: right;">
                <button type="button" class="btn btn-primary">
                    Посмотреть штрафы <span class="badge badge-danger"><?= $finesCount ?></span>
                </button>
            </td>
        </tr>
        <tr style="background-color: transparent">
            <td colspan="5" style="padding: 0;margin: 0;">
                <div class="collapse" id="collapseExample<?= $car->id ?>">
                    <table class="table table-hover table-dark" style="background-color: #343a40;">
                        <tbody>
                        <? foreach ($fines as $fine) { ?>
                            <tr>
                                <td scope="row"><?= ++$finesCounter ?></td>
                                <td scope="row"><?= $fine->billId ?>
                                    <? if ($fine->isNew()) { ?>
                                        <span class="badge badge-success">NEW!</span>
                                    <? } ?></td>
                                <td scope="row">
                                    <?= $fine->sum ?>
                                    <? if ($fine->discountSum != 0) { ?>
                                        <span class="badge badge-success" data-toggle="tooltip" data-placement="top"
                                              title="Скидка до <?= $fine->discountUntil ?>"><?= $fine->discountSum ?></span>
                                    <? } ?>
                                </td>
                                <td scope="row"><?= $fine->fineDate ?></td>
                                <td scope="row"><?= $fine->parseDate ?></td>
                                <td scope="row" style="width: 40%"><?= $fine->koapText ?></td>
                                <td scope="row" style="width: 5%">
                                    <button type="button" class="btn btn-info getphotobtn"
                                            data-fineid="<?= $fine->id ?>">Фото
                                    </button>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    <? } ?>
    </tbody>
</table>
<script src="front/js/scripts.js"></script>
</body>
</html>