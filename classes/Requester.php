<?

namespace classes;

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;

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
        $this->headers = Config::$headers;
        if (Config::USE_PROXY === true) {
            $this->proxy = [
                'http' => Config::HTTP_PROXY,
                'https' => Config::HTTPS_PROXY,
            ];
        }
    }

    public function secureCodeRequest(Car $car)
    {
        try {
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
        } catch (GuzzleException $e) {
        }
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
            return (string)$this->client->request('GET', 'https://shtrafyonline.ru/ajax/get_photos', [
                'headers' => $this->headers,
                'verify' => false,
                'cookies' => $this->jar,
                'proxy' => $this->proxy,
                'query' => [
                    'post' => $fine->billId,
                ],
            ])->getBody();
        //return '{"pics":[{"n":1,"r":269823338},{"n":2,"r":1559088186}],"count":2}';
    }

    public function photoSaver($photoId)
    {
            return $this->client->request('GET', "https://shtrafyonline.ru/ajax/photo_temp?n={$photoId['n']}&{$photoId['r']}.jpg", [
                'headers' => $this->headers,
                'verify' => false,
                'cookies' => $this->jar,
                'proxy' => $this->proxy,
            ])->getBody();
    }

//    private function makeRequest($url, $options)
//    {
//        return $this->client->request('GET', $url, $options);
//    }

}


?>