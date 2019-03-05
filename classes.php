<?
require_once __DIR__.'/vendor/autoload.php';


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

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
    public $id;
    public $number;
    public $region;
    public $stsNumber;

    public function __construct($id, $number, $region, $stsNumber)
    {
        $this->id = trim($id);
        $this->number = trim($number);
        $this->region = trim($region);
        $this->stsNumber = trim($stsNumber);

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
    public $id;
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
    public $car_id;
    public $parseDate;

    public function __construct($koapSt = null, $koapText = null, $fineDate = null, $sum = null, $billId = null, $hasDiscount = null, $hasPhoto = null, $divId = null, $discountSum = null, $discountUntil = null, $parseDate = null, $car_id = null, $id = null)
    {
        $this->id = $id;
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
        $this->car_id = $car_id;
        $this->parseDate = $parseDate;
    }

    public function toString()
    {
        return "Статья: {$this->koapSt} Нарушение: {$this->koapText} Дата штрафа: {$this->fineDate} Сумма без скидки: {$this->koapSt} № постановления: {$this->billId}";
    }

    public function isNew()
    {
        return (strtotime($this->parseDate) >= time() - 86400) ? 1 : 0;
    }
}

class PhotoParser
{
    private $billId;

    public function __construct(Fine $fine)
    {
        $this->billId = $fine->billId;
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
        $fines = [];
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
        return json_decode($response, true)['pics'];
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
            $cars[] = new Car(...array_map("trim", explode($this->delimiter, $carParams)));
        }
        return $cars;
    }
}

class DBCarList implements CarList
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCars()
    {
        $carsData = $this->db->query("SELECT * FROM `cars`")->fetchAll(PDO::FETCH_NUM);
        foreach ($carsData as $carData) {
            $cars[] = new Car(...$carData);
        }
        return $cars;
    }

    public function isUnique(Fine $fine)
    {
        $res = $this->db->query("SELECT * FROM shtrafy.fines WHERE billId = '$fine->billId' LIMIT 1");
        return ($res->rowCount() == 0) ? 0 : 1;
    }

    public function getAllFines(Car $car)
    {
        return $this->db->query("SELECT * FROM fines WHERE car_id = {$car->id}")->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Fine");
    }

    public function getFinesCount(Car $car)
    {
        return $this->db->query("SELECT COUNT(id) FROM fines WHERE car_id = {$car->id}")->fetch(PDO::FETCH_NUM)[0];
    }
}

class Requester
{
    private $client;
    private $jar;
    private $headers;
    private $proxy;

    public function __construct()
    {
        $this->client = new Client();
        $this->jar = new CookieJar();
        $this->headers = [
            'Host' => 'shtrafyonline.ru',
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,image/*,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        ];
        $this->proxy = [
            'http' => '127.0.0.1:8888',
            'https' => '127.0.0.1:8888',
        ];
    }

    public function secureCodeRequest(Car $car)
    {
        $response = (string)$this->client->request('GET', "https://shtrafyonline.ru/ajax/fines_gibdd_queue?num={$car->number}&reg={$car->region}&sts={$car->stsNumber}", [
            'headers' => $this->headers,
            'verify' => false,
            'cookies' => $this->jar,
//            'query' => [
//                'num' => [urlencode($car->number)],
//                'reg' => [$car->region],
//                'sts' => [$car->stsNumber],
//            ],
            'proxy' => $this->proxy,
        ])->getBody();
        //$response = '{"error":0,"key":"8f0deda3a6bb20f7815831e081e81f4b"}';
        if (!JsonResponseDecoder::checkErrors($response)) {
            return $response;
        } else {
            return 'error while parsing SecCode';
        }
    }

    public function finesRequest($secureCode, $delay = 0)
    {
        $finesResponse = (string)$this->client->request('GET', 'https://shtrafyonline.ru/ajax/fines_gibdd_queue_result', [
            'headers' => $this->headers,
            'verify' => false,
            'cookies' => $this->jar,
            'proxy' => $this->proxy,
            'query' => ['key' => $secureCode],
            'delay' => $delay,
        ])->getBody();

        if (JsonResponseDecoder::checkErrors($finesResponse)) {
            return 'error while parsing Fines';
        } elseif (!JsonResponseDecoder::checkErrors($finesResponse) && !JsonResponseDecoder::checkState($finesResponse)) {
            return $this->finesRequest($secureCode, 10000);
        } elseif (!JsonResponseDecoder::checkErrors($finesResponse) && JsonResponseDecoder::checkState($finesResponse)) {
            //$finesResponse = '{"error":0,"state":1,"data":{"error":0,"finesList":[{"koapSt":"","koapText":"\u041d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u0435 \u043f\u0440\u0430\u0432\u0438\u043b \u0440\u0430\u0441\u043f\u043e\u043b\u043e\u0436\u0435\u043d\u0438\u044f \u0442\u0440\u0430\u043d\u0441\u043f\u043e\u0440\u0442\u043d\u043e\u0433\u043e \u0441\u0440\u0435\u0434\u0441\u0442\u0432\u0430\r\n\r\n\u041c\u0435\u0441\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u044f:\r\n\u041c\u041e\u0421\u041a\u0412\u0410 \u0413. \u041c\u041a\u0410\u0414, 58 \u041a\u041c 950 \u041c, \u041f-\u041e\u041f\u041e\u0420\u0410, \u0412\u041d\u0423\u0422\u0420\u0415\u041d\u041d\u042f\u042f \u0421\u0422\u041e\u0420\u041e\u041d\u0410\r\n\r\n\u041c\u0430\u0440\u043a\u0430 \u0430\u0432\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0438\u0442\u0435\u043b\u044f:\r\n\u0428\u041a\u041e\u0414\u0410 \u041e\u041a\u0422\u0410\u0412\u0418\u042f\r\n\r\n","fineDate":"2018-11-28","sum":"1500","billId":"18810177181128202096","hasDiscount":0,"hasPhoto":1,"divId":"1145000","discountSum":"0","discountUntil":"0000-00-00"}],"count":1,"inGarage":0},"params":{"num":"\u0415414\u0415\u0412","reg":"799","sts":"7756261168"},"type":0}';
            return $finesResponse;
        }
    }

    public function photoIDsRequest(Fine $fine)
    {
        $response = (string)$this->client->request('GET', 'https://shtrafyonline.ru/ajax/get_photos', [
            'headers' => $this->headers,
            'verify' => false,
            'cookies' => $this->jar,
            'proxy' => $this->proxy,
            'query' => [
                'post' => $fine->billId,
            ],
        ])->getBody();
        return $response;
        //return '{"pics":[{"n":1,"r":269823338},{"n":2,"r":1559088186}],"count":2}';
    }

    public function photoSaver($photoId)
    {
        $request = $this->client->request('GET', "https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg", [
            'headers' => $this->headers,
            'verify' => false,
            'cookies' => $this->jar,
            'proxy' => $this->proxy,
        ]);
        return $request->getBody();
    }

}


?>