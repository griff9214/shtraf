<?
require_once 'vendor/autoload.php';

$cars = file('carlist.txt');

use GuzzleHttp\Client;

class Car{
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

class Fine{
    public $koapSt;
    public $koapText;
    public $fineDate;
    public $sum;
    public $billId;
    public $hasPhoto;
    public $hasDiscount;
    public $discountSum;
    public $discountUntil;
}
interface CarList{
    public function getCars();
}

class TxtCarList implements CarList{
    public function __construct($fnname, $delimiter)
    {
        $this->fname = $fnname;
        $this->delimiter = $delimiter;
    }

    public function getCars()
    {
        foreach (file($this->fname) as $carParams){
            $cars[] = new Car(...explode($this->delimiter, $carParams));
        }
        return $cars;
    }
}
$carlist = new TxtCarList('carlist.txt',":");

$car = $carlist->getCars()[0];
//print_r($car->number);
$client = new Client();
//$res = $client->request('GET', 'https://shtrafyonline.ru/ajax/fines_gibdd_queue', [
//    'num' => [$car->number],
//    'reg' => [$car->region],
//    'sts' => [$car->stsNumber],
//]);
//$response =  '{"error":0,"key":"8f0deda3a6bb20f7815831e081e81f4b"}';//$res->getBody();

//$secureKey = "906bd6add30ec7eabcda22985ef6123a"; //json_decode($response, true)['key'];

//$res = $client->request('GET', 'https://shtrafyonline.ru/ajax/fines_gibdd_queue_result', [
//    'query' => ['key' => $secureKey],
//]);
//echo $res->getBody();
$finesResponse = '{"error":0,"state":1,"data":{"error":0,"finesList":[{"koapSt":"","koapText":"\u041d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u0435 \u043f\u0440\u0430\u0432\u0438\u043b \u0440\u0430\u0441\u043f\u043e\u043b\u043e\u0436\u0435\u043d\u0438\u044f \u0442\u0440\u0430\u043d\u0441\u043f\u043e\u0440\u0442\u043d\u043e\u0433\u043e \u0441\u0440\u0435\u0434\u0441\u0442\u0432\u0430\r\n\r\n\u041c\u0435\u0441\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0435\u043d\u0438\u044f:\r\n\u041c\u041e\u0421\u041a\u0412\u0410 \u0413. \u041c\u041a\u0410\u0414, 58 \u041a\u041c 950 \u041c, \u041f-\u041e\u041f\u041e\u0420\u0410, \u0412\u041d\u0423\u0422\u0420\u0415\u041d\u041d\u042f\u042f \u0421\u0422\u041e\u0420\u041e\u041d\u0410\r\n\r\n\u041c\u0430\u0440\u043a\u0430 \u0430\u0432\u0442\u043e \u043d\u0430\u0440\u0443\u0448\u0438\u0442\u0435\u043b\u044f:\r\n\u0428\u041a\u041e\u0414\u0410 \u041e\u041a\u0422\u0410\u0412\u0418\u042f\r\n\r\n","fineDate":"2018-11-28","sum":"1500","billId":"18810177181128202096","hasDiscount":0,"hasPhoto":1,"divId":"1145000","discountSum":"0","discountUntil":"0000-00-00"}],"count":1,"inGarage":0},"params":{"num":"\u0415414\u0415\u0412","reg":"799","sts":"7756261168"},"type":0}';

print_r(json_decode($finesResponse, true)["data"]["finesList"]);

?>