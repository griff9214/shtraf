$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$('.getphotobtn').click(function () {
    showPhotos($(this).data('fineid'));
    //console.log($(this).data('fineid'));
});

function showPhotos(fineid) {
    //TODO поменять ответственность функций по получению URL и составлению модального окна

    if ($("#exampleModalCenter" + fineid).length > 0) {
        $("#exampleModalCenter" + fineid).modal();
    } else {
        //отправляю GET запрос и получаю ответ
        $.ajax({
            type: 'get',//тип запроса: get,post либо head
            url: 'ajax.php',//url адрес файла обработчика
            data: {'fineid': fineid},//параметры запроса
            response: 'JSON',//тип возвращаемого ответа text либо xml
            //TODO прописать код для ошибки запроса и для ответа-ошибки
            success: function (data) {//возвращаемый результат от сервера
                console.log(JSON.parse(data));
                makeModalGallery(JSON.parse(data), fineid);
            }
        });
    }
}

function makeModalGallery(photoUrls, fineid) {
    var galleryInner = photoUrls.reduce(
        function (code, url, index) {
            if (index == 0) {
                var active = 'active';
            } else {
                var active = '';
            }
            return code + '<div class="carousel-item ' + active + '">' +
                '<img src="' + url + '" class="d-block w-100">' +
                '</div>';
        }, '');

    var galleryOuter = '<div id="carousel' + fineid + '" class="carousel slide carousel-fade" data-ride="carousel">\n' +
        '                    <div class="carousel-inner">\n' + galleryInner +
        '                    </div>\n' +
        '                    <a class="carousel-control-prev" href="#carousel' + fineid + '" role="button" data-slide="prev">\n' +
        '                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '                        <span class="sr-only">Previous</span>\n' +
        '                    </a>\n' +
        '                    <a class="carousel-control-next" href="#carousel' + fineid + '" role="button" data-slide="next">\n' +
        '                        <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '                        <span class="sr-only">Next</span>\n' +
        '                    </a>\n' +
        '                </div>\n';

    var modal = '<div class="modal fade" id="exampleModalCenter' + fineid + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">\n' +
        '    <div class="modal-dialog modal-dialog-centered" role="document">\n' +
        '        <div class="modal-content">\n' +
        '            <div class="modal-header">\n' +
        '                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>\n' +
        '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
        '                    <span aria-hidden="true">&times;</span>\n' +
        '                </button>\n' +
        '            </div>\n' +
        '            <div class="modal-body">\n' + galleryOuter +
        '            </div>\n' +
        '            <div class="modal-footer">\n' +
        '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>';

    $("body").append(modal);
    $("#exampleModalCenter" + fineid).modal();
}