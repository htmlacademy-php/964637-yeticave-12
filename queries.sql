INSERT INTO categories
VALUES (NULL, 'Доски и лыжи', NULL),
       (NULL, 'Крепления', NULL),
       (NULL, 'Ботинки', NULL),
       (NULL, 'Одежда', NULL),
       (NULL, 'Инструменты', NULL),
       (NULL, 'Разное', NULL);

INSERT INTO users
VALUES (NULL, CURRENT_TIMESTAMP - interval 1 WEEK, 'user1@xxx.com', 'user1', '012345user1', '934534850983409'),
       (NULL, CURRENT_TIMESTAMP - interval 3 week, 'user2@xxx.com', 'user2', '012345user2', '96945675450983409');

INSERT INTO lots
VALUES (NULL, CURRENT_TIMESTAMP - interval 1 WEEK, CURRENT_TIMESTAMP + interval 1 WEEK, '2014 Rossignol District Snowboard',
       'Легкий маневренный сноуборд', 'img/lot-1.jpg', 10999, 500, 1, NULL, 1),
       (NULL, CURRENT_TIMESTAMP - interval 2 WEEK, CURRENT_TIMESTAMP + interval 2 WEEK, 'Крепления Union Contact Pro 2015 года размер L/XL',
       'Легкий маневренный сноуборд', 'img/lot-3.jpg', 8000, 200, 2, NULL, 2),
       (NULL, CURRENT_TIMESTAMP - interval 3 WEEK, CURRENT_TIMESTAMP + interval 3 WEEK, 'Ботинки для сноуборда DC Mutiny Charocal',
       'Легкий маневренный сноуборд', 'img/lot-4.jpg', 10999, 400, 1, NULL, 3),
       (NULL, CURRENT_TIMESTAMP - interval 4 WEEK, CURRENT_TIMESTAMP + interval 4 WEEK, 'Куртка для сноуборда DC Mutiny Charocal',
       'Легкий маневренный сноуборд', 'img/lot-5.jpg', 7500, 100, 2, NULL, 4),
       (NULL, CURRENT_TIMESTAMP - interval 5 WEEK, CURRENT_TIMESTAMP + interval 5 WEEK, 'Маска Oakley Canopy',
       'Легкий маневренный сноуборд', 'img/lot-6.jpg', 5400, 100, 1, NULL, 6);
       
INSERT INTO bets
VALUES (NULL, CURRENT_TIMESTAMP, 11799, 3, 2);
INSERT INTO bets
VALUES (NULL, CURRENT_TIMESTAMP, 11399, 3, 1);

SELECT *, 
       (select title
  	       from categories
         where id = lots.category_id)
  from lots
 where id = 3;

UPDATE lots
   SET title = 'Тапочки для сноуборда CD Chutiny Marocal'
 where id = 3;

SELECT *
  FROM bets
 WHERE lot_id = 3
 ORDER BY dt_add DESC;
