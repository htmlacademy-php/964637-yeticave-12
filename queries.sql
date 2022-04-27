-- Добавляем категории товаров
INSERT INTO categories (title, simbolic_code)
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');

-- Добавляем пользователей
INSERT INTO users (dt_add, email, name, password, contact)
VALUES (CURRENT_TIMESTAMP - interval 1 WEEK, 'user1@xxx.com', 'user1', '012345user1', '934534850983409'),
       (CURRENT_TIMESTAMP - interval 3 week, 'user2@xxx.com', 'user2', '012345user2', '96945675450983409');

-- Добавляем активные лоты
INSERT INTO lots (dt_add, completion_dt, title, description, image, starting_price, bet_step, author_id, category_id)
VALUES (CURRENT_TIMESTAMP - interval 1 WEEK, CURRENT_TIMESTAMP + interval 1 WEEK, '2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд', 'img/lot-1.jpg', 10999, 500, 1, 1),
       (CURRENT_TIMESTAMP - interval 2 WEEK, CURRENT_TIMESTAMP + interval 2 WEEK, 'Крепления Union Contact Pro 2015 года размер L/XL', 'Легкий маневренный сноуборд', 'img/lot-3.jpg', 8000, 200, 2, 2),
       (CURRENT_TIMESTAMP - interval 3 WEEK, CURRENT_TIMESTAMP + interval 3 WEEK, 'Ботинки для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд', 'img/lot-4.jpg', 10999, 400, 1, 3),
       (CURRENT_TIMESTAMP - interval 4 WEEK, CURRENT_TIMESTAMP + interval 4 WEEK, 'Куртка для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд', 'img/lot-5.jpg', 7500, 100, 2, 4),
       (CURRENT_TIMESTAMP - interval 5 WEEK, CURRENT_TIMESTAMP + interval 5 WEEK, 'Маска Oakley Canopy',
       'Легкий маневренный сноуборд', 'img/lot-6.jpg', 5400, 100, 1, 6);

-- Добавляем ставки по активным лотам
INSERT INTO bets (dt_add, bet_value, lot_id, user_id)
VALUES (CURRENT_TIMESTAMP, 11799, 3, 2),
       (CURRENT_TIMESTAMP, 11399, 3, 1);

-- Получаем все категории
SELECT *
  FROM categories;

-- Получаем самые новые, открытые лоты, включающие название, стартовую цену, ссылку на изображение, цену, название категории
SELECT l.title, l.starting_price, l.image, c.title,
       (SELECT IFNULL(MAX(b.bet_value), l.starting_price)
		    FROM bets AS b
			WHERE b.lot_id = l.id) AS current_price 
  FROM lots AS l
       JOIN categories AS c ON l.category_id = c.id
 WHERE completion_dt > CURRENT_TIMESTAMP;

-- Показываем лот по его id, название категории, к которой принадлежит лот  
SELECT l.id, dt_add,  completion_dt, l.title, description, image, starting_price, bet_step, author_id, winner_id, category_id, c.title
  FROM lots AS l
       JOIN categories AS c
       ON l.category_id = c.id
 WHERE l.id = 3;

-- Обновляем название лота по его идентификатору
UPDATE lots
   SET title = 'Тапочки для сноуборда CD Chutiny Marocal'
 where id = 3;


-- Получаем список ставок для лота по его идентификатору с сортировкой по дате
SELECT *
  FROM bets
 WHERE lot_id = 3
 ORDER BY dt_add DESC;
 