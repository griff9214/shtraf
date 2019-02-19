<?
require_once 'vendor/autoload.php';

$cars = file('carlist.txt');

use GuzzleHttp\Client;

interface CarList
{
    public function getCars();
}

interface ResponseDecoder
{
    public static function checkErrors($response);

    public static function checkState($response);

    public static function getSecureCode($response);

    public static function getFines($response);

    public static function getPhotoIds($response);
}

class Car
{
    public $number;
    public $region;
    public $stsNumber;

    public function __construct($number, $region, $stsNumber)
    {
        $this->number = $number;
        $this->region = $region;
        $this->stsNumber = $stsNumber;

    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getStsNumber()
    {
        return $this->stsNumber;
    }
}

class Fine
{
    public $koapSt;
    public $koapText;
    public $fineDate;
    public $sum;
    public $billId;
    public $hasDiscount;
    public $hasPhoto;
    public $divId;
    public $discountSum;
    public $discountUntil;

    public function __construct($koapSt, $koapText, $fineDate, $sum, $billId, $hasDiscount, $hasPhoto, $divId, $discountSum, $discountUntil)
    {
        $this->koapSt = $koapSt;
        $this->koapText = $koapText;
        $this->fineDate = $fineDate;
        $this->sum = $sum;
        $this->billId = $billId;
        $this->hasDiscount = $hasDiscount;
        $this->hasPhoto = $hasPhoto;
        $this->divId = $divId;
        $this->discountSum = $discountSum;
        $this->discountUntil = $discountUntil;
    }
}

class PhotoParser
{
    private $billId;

    public function __construct(Fine $fine)
    {
        $this->billId = $fine->billId;
    }

    function photoRequest()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://shtrafyonline.ru/ajax/get_photos', [
            'query' => [
                //'numreg' => $secureCode,
                'post' => $this->billId,
                //'divid' => $fine->divId,
            ],
        ]);
        return $res->getBody();
        //return '{"pics":[{"n":1,"r":269823338},{"n":2,"r":1559088186}],"count":2}';
    }

    function getPhotoIds()
    {
        return json_decode($this->photoRequest(), true)['pics'];
//        return array_reduce($photosArr, function ($res, $item) {
//            $res[] = $item['r'];
//            return $res;
//        });
    }
}

class JsonResponseDecoder implements ResponseDecoder
{
    public static function checkErrors($response)
    {
        return (json_decode($response)->error) ? 1 : 0;
    }

    public static function checkState($response)
    {
        return (json_decode($response)->state) ? 1 : 0;
    }

    public static function getFines($response)
    {
        foreach (json_decode($response, true)["data"]["finesList"] as $item) {

            $fines[] = new Fine(...array_values($item));
        }
        return $fines;
    }

    public static function getSecureCode($response)
    {
        return json_decode($response, true)['key'];
    }

    public static function getPhotoIds($response)
    {
        //{"pics":[{"n":1,"r":1082868573},{"n":2,"r":1912246917}],"count":2}
        return json_decode($response, true)['key'];
    }
}

class TxtCarList implements CarList
{
    private $fname;
    private $delimiter;

    public function __construct($fnname, $delimiter = ':')
    {
        $this->fname = $fnname;
        $this->delimiter = $delimiter;
    }

    public function getCars()
    {
        foreach (file($this->fname) as $carParams) {
            $cars[] = new Car(...explode($this->delimiter, $carParams));
        }
        return $cars;
    }
}

function secureCodeRequest(Car $car)
{
    $client = new Client();
    //$res = $client->request('GET', 'https://shtrafyonline.ru/ajax/fines_gibdd_queue', [
    //    'num' => [$car->number],
    //    'reg' => [$car->region],
    //    'sts' => [$car->stsNumber],
    //]);

    //$response = $res->getBody();
    $response = '{"error":0,"key":"8f0deda3a6bb20f7815831e081e81f4b"}';

    if (!JsonResponseDecoder::checkErrors($response)) {
        return $response;
    } else {
        return 'error while parsing SecCode';
    }
}

function finesRequest($secureCode, $delay = 0)
{
//    $client = new Client();
//    $res = $client->request('GET', 'https://shtrafyonline.ru/ajax/fines_gibdd_queue_result', [
//        'query' => ['key' => $secureCode],
//        'delay' => [$delay],
//    ]);
//    $finesResponse = json_decode($res->getBody());
    $finesResponse = json_decode('{"error":0,"state":1}');
    if (JsonResponseDecoder::checkErrors($finesResponse)) {
        return 'error while parsing Fines';
    } elseif (!JsonResponseDecoder::checkErrors($finesResponse) && !JsonResponseDecoder::checkState($finesResponse)) {
        echo "state 0: new querry with delay $delay\r\n";
        finesRequest($secureCode, 10000);
    } elseif (!JsonResponseDecoder::checkErrors($finesResponse) && JsonResponseDecoder::checkState($finesResponse)) {
        //$finesResponse = json_decode($response);
        $finesResponse = '{"error":0,"state":1,"data":{"error":0,"finesList":[{"koapSt":"","koapText":"\u041d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u0435 \u043f\u0440\u0430\u0432\u0438\u043b \u0440\u0430\u0441\u043f\u043e\u043b\u043e\u0436\u0435\u043d\u0438\u044f \u0442\u0440\u0430\u043d\u0441\u043f\u043e\u0440\u0442\u043d\u043e\u0433\u043e \u0441\u0440\u0435\u0434\u0441\u0442\u0432\u0430\r\n\r\n\u041c\u0435\u0441\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u044f:\r\n\u041c\u041e\u0421\u041a\u0412\u0410 \u0413. \u041c\u041a\u0410\u0414, 58 \u041a\u041c 950 \u041c, \u041f-\u041e\u041f\u041e\u0420\u0410, \u0412\u041d\u0423\u0422\u0420\u0415\u041d\u041d\u042f\u042f \u0421\u0422\u041e\u0420\u041e\u041d\u0410\r\n\r\n\u041c\u0430\u0440\u043a\u0430 \u0430\u0432\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0438\u0442\u0435\u043b\u044f:\r\n\u0428\u041a\u041e\u0414\u0410 \u041e\u041a\u0422\u0410\u0412\u0418\u042f\r\n\r\n","fineDate":"2018-11-28","sum":"1500","billId":"18810177181128202096","hasDiscount":0,"hasPhoto":1,"divId":"1145000","discountSum":"0","discountUntil":"0000-00-00"}],"count":1,"inGarage":0},"params":{"num":"\u0415414\u0415\u0412","reg":"799","sts":"7756261168"},"type":0}';
        return $finesResponse;
    }
}

$carlist = new TxtCarList("carlist.txt", ':');
$car = $carlist->getCars()[0];

$finesResponse = '{"error":0,"state":1,"data":{"error":0,"finesList":[{"koapSt":"","koapText":"\u041d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u0435 \u043f\u0440\u0430\u0432\u0438\u043b \u0440\u0430\u0441\u043f\u043e\u043b\u043e\u0436\u0435\u043d\u0438\u044f \u0442\u0440\u0430\u043d\u0441\u043f\u043e\u0440\u0442\u043d\u043e\u0433\u043e \u0441\u0440\u0435\u0434\u0441\u0442\u0432\u0430\r\n\r\n\u041c\u0435\u0441\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u044f:\r\n\u041c\u041e\u0421\u041a\u0412\u0410 \u0413. \u041c\u041a\u0410\u0414, 58 \u041a\u041c 950 \u041c, \u041f-\u041e\u041f\u041e\u0420\u0410, \u0412\u041d\u0423\u0422\u0420\u0415\u041d\u041d\u042f\u042f \u0421\u0422\u041e\u0420\u041e\u041d\u0410\r\n\r\n\u041c\u0430\u0440\u043a\u0430 \u0430\u0432\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0438\u0442\u0435\u043b\u044f:\r\n\u0428\u041a\u041e\u0414\u0410 \u041e\u041a\u0422\u0410\u0412\u0418\u042f\r\n\r\n","fineDate":"2018-11-28","sum":"1500","billId":"18810177181128202096","hasDiscount":0,"hasPhoto":1,"divId":"1145000","discountSum":"0","discountUntil":"0000-00-00"}],"count":1,"inGarage":0},"params":{"num":"\u0415414\u0415\u0412","reg":"799","sts":"7756261168"},"type":0}';

$fines = JsonResponseDecoder::getFines($finesResponse);

$photoParser = new PhotoParser($fines[0]);

echo $photoParser->photoRequest();
foreach ($photoParser->getPhotoIds() as $photoId) {
    echo "https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg\r\n";
    copy("https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg", "photo/{$photoId['r']}.jpg");
    //file_put_contents("photo/{$photoId['r']}.jpg", file_get_contents("https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg"));
//    $client = new Client();
//    $resource = fopen("photo/{$photoId['r']}.jpg", 'w');
//    $client->request('GET', "https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg", ['sink' => $resource]);
//    fclose($resource);
}
?>