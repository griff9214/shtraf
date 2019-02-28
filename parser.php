<?php

require_once 'vendor/autoload.php';
require_once 'classes.php';
require_once 'config.php';

//$carlist = new TxtCarList("carlist.txt", ':');
$requester = new Requester();

//---------------

$carlist = new DBCarList($DB);

//---------------
//foreach ($carlist->getCars() as $currentCar) {
$currentCar = $carlist->getCars()[2];
//$secureCode = JsonResponseDecoder::getSecureCode($requester->secureCodeRequest($currentCar));
//
//$finesResponse = $requester->finesRequest($secureCode);

 $finesResponse = '{"error":0,"state":1,"data":{"error":0,"finesList":[{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810177190218155028","fineDate":"2019-02-18","sum":500,"billId":"18810177190218155028","hasDiscount":1,"hasPhoto":1,"divId":0,"discountSum":"250","discountUntil":"2019-03-11"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810177190213095876","fineDate":"2019-02-13","sum":500,"billId":"18810177190213095876","hasDiscount":1,"hasPhoto":1,"divId":0,"discountSum":"250","discountUntil":"2019-03-05"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810169190115005412","fineDate":"2019-01-15","sum":"500","billId":"18810169190115005412","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810169190115005382","fineDate":"2019-01-15","sum":"500","billId":"18810169190115005382","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810177190108273875","fineDate":"2019-01-08","sum":"500","billId":"18810177190108273875","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810166181029141699","fineDate":"2018-10-29","sum":"500","billId":"18810166181029141699","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810166181012000426","fineDate":"2018-10-12","sum":"500","billId":"18810166181012000426","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810166181011065702","fineDate":"2018-10-11","sum":"500","billId":"18810166181011065702","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810166181009095861","fineDate":"2018-10-09","sum":"500","billId":"18810166181009095861","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180926057042","fineDate":"2018-09-26","sum":"500","billId":"18810152180926057042","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180926002817","fineDate":"2018-09-26","sum":"500","billId":"18810152180926002817","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180926085164","fineDate":"2018-09-26","sum":"500","billId":"18810152180926085164","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180926075628","fineDate":"2018-09-26","sum":"500","billId":"18810152180926075628","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180925137026","fineDate":"2018-09-25","sum":"500","billId":"18810152180925137026","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180925135384","fineDate":"2018-09-25","sum":"500","billId":"18810152180925135384","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180925135112","fineDate":"2018-09-25","sum":"500","billId":"18810152180925135112","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180924064394","fineDate":"2018-09-24","sum":"500","billId":"18810152180924064394","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180924058726","fineDate":"2018-09-24","sum":"500","billId":"18810152180924058726","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810152180924089613","fineDate":"2018-09-24","sum":"500","billId":"18810152180924089613","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810150180914615415","fineDate":"2018-09-14","sum":"500","billId":"18810150180914615415","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810177180910873537","fineDate":"2018-09-10","sum":"500","billId":"18810177180910873537","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"},{"koapSt":"","koapText":"\u0428\u0422\u0420\u0410\u0424 \u041f\u041e \u0410\u0414\u041c\u0418\u041d\u0418\u0421\u0422\u0420\u0410\u0422\u0418\u0412\u041d\u041e\u041c\u0423 \u041f\u0420\u0410\u0412\u041e\u041d\u0410\u0420\u0423\u0428\u0415\u041d\u0418\u042e \u041f\u041e\u0421\u0422\u0410\u041d\u041e\u0412\u041b\u0415\u041d\u0418\u0415 \u211618810177180906111237","fineDate":"2018-09-06","sum":"2000","billId":"18810177180906111237","hasDiscount":0,"hasPhoto":1,"divId":0,"discountSum":"0","discountUntil":"0000-00-00"}],"count":22,"inGarage":0},"params":{"num":"\u0420243\u041e\u0425","reg":"77","sts":"7761040908"},"type":0}';
$fines = JsonResponseDecoder::getFines($finesResponse);

if (count($fines) != 0) {
    //$currentFine = $fines[0];
    if (!is_dir(__DIR__ . "/{$currentCar->number}")) {
        mkdir(__DIR__ . "/{$currentCar->number}");
    }

    $currentDir = "{$currentCar->number}";

    foreach ($fines as $currentFine) {


        if (!$carlist->isUnique($currentFine)) {

            $currentDir = "{$currentCar->number}";
            if (!is_dir("{$currentDir}/{$currentFine->billId}")) {
                mkdir("{$currentDir}/{$currentFine->billId}");
                $currentDir = "{$currentDir}/{$currentFine->billId}";
            }

            //------- Save fine as txt
//            $currentDir = "{$currentDir}/{$currentFine->billId}";
//            file_put_contents("{$currentDir}/{$currentFine->billId}.txt", $currentFine->toString());
            //------- Save fine as txt


            //---------- Save Fine to DB
            $query = "INSERT INTO shtrafy.fines (koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id) VALUES ('{$currentFine->koapSt}','{$currentFine->koapText}', '{$currentFine->fineDate}', '{$currentFine->sum}', '{$currentFine->billId}', '{$currentFine->hasDiscount}', '{$currentFine->hasPhoto}', '{$currentFine->divId}', '{$currentFine->discountSum}', '{$currentFine->discountUntil}', '{$currentCar->id}')";
            $q = $DB->prepare($query);
            $q->execute();
            $lastId = $DB->query("SELECT LAST_INSERT_ID()")->fetch(PDO::FETCH_NUM)[0];
            //---------- Save Fine to DB

            //------- Save Photos JPG
            if ($currentFine->hasPhoto) {
                $photosJson = $requester->photoIDsRequest($currentFine);
                $photoIds = JsonResponseDecoder::getPhotoIds($photosJson);
                foreach ($photoIds as $photoId) {
                    $photo = $requester->photoSaver($photoId);
                    file_put_contents("{$currentDir}/{$photoId['r']}.jpg", $photo);
                    $query = "INSERT INTO shtrafy.photos (imgUrl, fineId) VALUES ('{$currentDir}/{$photoId['r']}.jpg', '{$lastId}')";
                    $q = $DB->prepare($query);
                    $q->execute();
                    echo "http://shtraf/{$currentDir}/{$photoId['r']}.jpg\r\n";
                }
            }
            //------- Save Photos JPG

        }
    }
    echo "{$currentCar->number} - " . count($fines) . " штрафов\r\n";
} else {
    echo "{$currentCar->number} - штрафов нет\r\n";
}
//}
?>