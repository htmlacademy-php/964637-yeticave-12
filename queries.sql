-- Добавляем категории товаров
INSERT INTO categories (title, symbolic_code)
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');

-- Добавляем пользователей
INSERT INTO users (dt_add, email, user_name, user_password, contact)
VALUES (CURRENT_TIMESTAMP - interval 1 WEEK, 'user1@xxx.com', 'user1', '012345user1', '934534850983409'),
       (CURRENT_TIMESTAMP - interval 3 week, 'user2@xxx.com', 'user2', '012345user2', '96945675450983409');
`schema`
-- Добавляем активные лоты
INSERT INTO lots (lot_name, category_id, message, lot_img, lot_rate, lot_step, lot_date, dt_add, author_id, winner_id)
VALUES ('2014 Rossignol District Snowboard', 1, 'Легкий маневренный сноуборд', 'img/lot-1.jpg', 10999, 500, CURRENT_TIMESTAMP + interval 1 WEEK, CURRENT_TIMESTAMP - interval 1 WEEK, 1, NULL),
       ('Крепления Union Contact Pro 2015 года размер L/XL', 2, 'Легкий маневренный сноуборд', 'img/lot-3.jpg', 8000, 200, CURRENT_TIMESTAMP + interval 2 WEEK, CURRENT_TIMESTAMP - interval 2 WEEK, 2, NULL),
       ('Ботинки для сноуборда DC Mutiny Charocal', 3, 'Легкий маневренный сноуборд', 'img/lot-4.jpg', 20000, 700, CURRENT_TIMESTAMP + interval 3 WEEK, CURRENT_TIMESTAMP - interval 3 WEEK, 1, NULL),
       ('Куртка для сноуборда DC Mutiny Charocal', 4, 'Легкий маневренный сноуборд', 'img/lot-5.jpg', 15963, 600, CURRENT_TIMESTAMP + interval 4 WEEK, CURRENT_TIMESTAMP - interval 4 WEEK, 2, NULL),
       ('Маска Oakley Canopy', 6, 'Легкий маневренный сноуборд', 'img/lot-6.jpg', 7650, 400, CURRENT_TIMESTAMP + interval 5 WEEK, CURRENT_TIMESTAMP - interval 5 WEEK, 1, NULL);

-- Добавляем ставки по активным лотам
INSERT INTO bets (dt_add, rate, lot_id, user_id)
VALUES (CURRENT_TIMESTAMP, 11799, 3, 2),
       (CURRENT_TIMESTAMP, 11399, 3, 1);

-- Получаем все категории
SELECT *
  FROM categories;

-- Получаем самые новые, открытые лоты, включающие название, стартовую цену, ссылку на изображение, цену, название категории
SELECT l.lot_name, l.lot_rate, l.lot_img, c.title,
       (SELECT IFNULL(MAX(b.rate), l.lot_rate)
		    FROM bets AS b
			WHERE b.lot_id = l.id) AS current_price 
  FROM lots AS l
       JOIN categories AS c ON l.category_id = c.id
 WHERE lot_date > CURRENT_TIMESTAMP;

-- Показываем лот по его id, название катеcategoriesгории, к которой принадлежит лот  
SELECT l.id, l.dt_add, l.lot_date, l.lot_name, l.message, l.lot_img, l.lot_rate, l.lot_step, l.author_id, l.winner_id, l.category_id, c.title
  FROM lots AS l
       JOIN categories AS c
       ON l.category_id = c.id
 WHERE l.id = 3;

-- Обновляем название лота по его идентификатору
UPDATE lots
   SET lot_name = 'Тапочки для сноуборда CD Chutiny Marocal'
 where id = 3;


-- Получаем список ставок для лота по его идентификатору с сортировкой по дате
SELECT *
  FROM bets
 WHERE lot_id = 3
 ORDER BY dt_add DESC;
