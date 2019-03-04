$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
$('.getphotobtn').click(function(){
    getPhotos($(this).data('fineid'));
    //console.log($(this).data('fineid'));
});
function getPhotos(fineid) {
    //отправляю GET запрос и получаю ответ
    $.ajax({
        type:'get',//тип запроса: get,post либо head
        url:'ajax.php',//url адрес файла обработчика
        data:'fineid=' + fineid,//параметры запроса
        response:'json',//тип возвращаемого ответа text либо xml
        success:function (data) {//возвращаемый результат от сервера
            console.log(JSON.parse(data));
        }
    });
}