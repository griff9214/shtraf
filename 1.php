<?
require_once __DIR__ . '/vendor/autoload.php';

use classes\Controller;
use classes\Fine;

error_reporting(E_ALL);

$controller = new Controller();

$controller->set('fine', function (){
    return new Fine();
});


$fine = $controller->get('fine');
$fine1 = $controller->get('fine');
$fine2 = $controller->get('fine');


var_dump($fine);
var_dump($fine1);
var_dump($fine2);
