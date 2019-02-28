CREATE TABLE shtrafy.cars
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    num text NOT NULL,
    region int(11) NOT NULL,
    sts text NOT NULL
);
CREATE UNIQUE INDEX cars_id_uindex ON shtrafy.cars (id);
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (1, 'А175СС', 750, '9906638127');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (2, 'Х678КО', 197, '7760478408');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (3, 'Р243ОХ', 77, '7761040908');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (4, 'Е686РТ', 190, '7761148925');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (5, 'Х103ЕС', 799, '7761040013');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (6, 'С153НА', 750, '7760928975');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (7, 'О949МК', 40, '7754518416');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (8, 'А194СО', 190, '7761148196');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (9, 'Х075ТН', 197, '7760929698');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (10, 'Н434ТХ', 97, '7760480804');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (11, 'О367ЕК', 150, '7761073619');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (12, 'Х345ОВ', 199, '7760478252');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (13, 'Е509УТ', 190, '7760929302');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (14, 'Н270МХ', 190, '7761147850');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (15, 'Т962ММ', 97, '7760480624');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (16, 'Т807НР', 197, '7761040341');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (17, 'О870СР', 190, '7760930343');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (18, 'М170ВО', 750, '7750945318');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (19, 'У546НЕ', 190, '7761040583');
INSERT INTO shtrafy.cars (id, num, region, sts) VALUES (20, 'Т246АМ', 799, '7761149381');
CREATE TABLE shtrafy.fines
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    koapSt text,
    koapText text,
    fineDate date,
    sum float,
    billId text,
    hasDiscount tinyint(1) DEFAULT '0',
    hasPhoto tinyint(1),
    divId text,
    discountSum float,
    discountUntil text,
    car_id int(11) NOT NULL,
    parseDate datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fines_ibfk_1 FOREIGN KEY (car_id) REFERENCES shtrafy.cars (id) ON DELETE CASCADE
);
CREATE INDEX car_id ON shtrafy.fines (car_id);
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (1, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810177190218155028', '2019-02-18', 500, '18810177190218155028', 1, 1, '0', 250, '2019-03-11', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (2, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810177190213095876', '2019-02-13', 500, '18810177190213095876', 1, 1, '0', 250, '2019-03-05', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (3, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810169190115005412', '2019-01-15', 500, '18810169190115005412', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (4, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810169190115005382', '2019-01-15', 500, '18810169190115005382', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (5, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810177190108273875', '2019-01-08', 500, '18810177190108273875', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (6, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810166181029141699', '2018-10-29', 500, '18810166181029141699', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (7, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810166181012000426', '2018-10-12', 500, '18810166181012000426', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (8, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810166181011065702', '2018-10-11', 500, '18810166181011065702', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (9, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810166181009095861', '2018-10-09', 500, '18810166181009095861', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (10, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180926057042', '2018-09-26', 500, '18810152180926057042', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (11, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180926002817', '2018-09-26', 500, '18810152180926002817', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (12, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180926085164', '2018-09-26', 500, '18810152180926085164', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (13, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180926075628', '2018-09-26', 500, '18810152180926075628', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (14, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180925137026', '2018-09-25', 500, '18810152180925137026', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (15, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180925135384', '2018-09-25', 500, '18810152180925135384', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (16, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180925135112', '2018-09-25', 500, '18810152180925135112', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (22, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810177180906111237', '2018-09-06', 2000, '18810177180906111237', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 10:18:57');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (41, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180924064394', '2018-09-24', 500, '18810152180924064394', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 11:21:06');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (42, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180924058726', '2018-09-24', 500, '18810152180924058726', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 11:21:06');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (43, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810152180924089613', '2018-09-24', 500, '18810152180924089613', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 11:21:06');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (47, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810150180914615415', '2018-09-14', 500, '18810150180914615415', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 11:23:28');
INSERT INTO shtrafy.fines (id, koapSt, koapText, fineDate, sum, billId, hasDiscount, hasPhoto, divId, discountSum, discountUntil, car_id, parseDate) VALUES (51, '', 'ШТРАФ ПО АДМИНИСТРАТИВНОМУ ПРАВОНАРУШЕНИЮ ПОСТАНОВЛЕНИЕ №18810177180910873537', '2018-09-10', 500, '18810177180910873537', 0, 1, '0', 0, '0000-00-00', 3, '2019-02-28 12:49:02');
CREATE TABLE shtrafy.photos
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    imgUrl text,
    fineId int(11),
    CONSTRAINT photos_ibfk_1 FOREIGN KEY (fineId) REFERENCES shtrafy.fines (id) ON DELETE CASCADE
);
CREATE INDEX fineId ON shtrafy.photos (fineId);
INSERT INTO shtrafy.photos (id, imgUrl, fineId) VALUES (7, 'Р243ОХ/18810177180910873537/1091024315.jpg', 51);
INSERT INTO shtrafy.photos (id, imgUrl, fineId) VALUES (8, 'Р243ОХ/18810177180910873537/781834940.jpg', 51);