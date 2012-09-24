-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 19.09.2012 22:05:45
-- Версия сервера: 5.5.16
-- Версия клиента: 4.1

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE insur_db;

--
-- Описание для таблицы insur_article_categories
--
DROP TABLE IF EXISTS insur_article_categories;
CREATE TABLE insur_article_categories (
  id INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_object_category
--
DROP TABLE IF EXISTS insur_object_category;
CREATE TABLE insur_object_category (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_users
--
DROP TABLE IF EXISTS insur_users;
CREATE TABLE insur_users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  status INT(11) NOT NULL,
  role VARCHAR(25) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_workers_roles
--
DROP TABLE IF EXISTS insur_workers_roles;
CREATE TABLE insur_workers_roles (
  id INT(11) NOT NULL AUTO_INCREMENT,
  role_name VARCHAR(45) DEFAULT NULL COMMENT 'РґРѕР»Р¶РЅРѕСЃС‚СЊ',
  description VARCHAR(45) DEFAULT NULL COMMENT 'РћРїРёСЃР°РЅРёРµ РґРѕР»Р¶РЅРѕСЃС‚Рё',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_coworkers
--
DROP TABLE IF EXISTS insur_coworkers;
CREATE TABLE insur_coworkers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_role INT(11) NOT NULL COMMENT 'id РґРѕР»Р¶РЅРѕСЃС‚Рё',
  name_middlename_surname TEXT DEFAULT NULL COMMENT 'Р¤Р°РјРёР»РёСЏ, РёРјСЏ, РѕС‚С‡РµСЃС‚РІРѕ',
  insur_workers_roles_id INT(11) NOT NULL,
  PRIMARY KEY (id, insur_workers_roles_id),
  CONSTRAINT fk_insur_coworkers_insur_workers_roles FOREIGN KEY (insur_workers_roles_id)
    REFERENCES insur_workers_roles(id) ON DELETE NO ACTION ON UPDATE NO ACTION
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_insurance_object
--
DROP TABLE IF EXISTS insur_insurance_object;
CREATE TABLE insur_insurance_object (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  status INT(11) DEFAULT 0,
  parent_id INT(11) DEFAULT NULL,
  `action` VARCHAR(255) DEFAULT NULL,
  category_id INT(11) DEFAULT NULL,
  date_changes DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX category_id (category_id),
  CONSTRAINT FK_insur_insurance_object_insur_object_category_id FOREIGN KEY (category_id)
    REFERENCES insur_object_category(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 71
AVG_ROW_LENGTH = 237
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_article_content
--
DROP TABLE IF EXISTS insur_article_content;
CREATE TABLE insur_article_content (
  id INT(11) NOT NULL AUTO_INCREMENT,
  content LONGTEXT DEFAULT NULL,
  created DATETIME DEFAULT NULL COMMENT 'РґР°С‚Р°/РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ',
  status INT(11) DEFAULT NULL COMMENT 'РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ - РѕРїСѓР±Р»РёРєРѕРІР°РЅР°, РґРѕСЃС‚СѓРїРЅР°. -1 - Р·Р°Р±Р»РѕРєРёСЂРѕРІР°РЅР°',
  insur_coworkers_id INT(11) NOT NULL,
  object_id INT(11) DEFAULT NULL,
  PRIMARY KEY (id, insur_coworkers_id),
  CONSTRAINT fk_insur_article_content_insur_coworkers1 FOREIGN KEY (insur_coworkers_id)
    REFERENCES insur_coworkers(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT FK_insur_article_content_insur_insurance_object_id FOREIGN KEY (object_id)
    REFERENCES insur_insurance_object(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = '													';

-- 
-- Вывод данных для таблицы insur_article_categories
--
-- Таблица insur_db.insur_article_categories не содержит данных

-- 
-- Вывод данных для таблицы insur_object_category
--
INSERT INTO insur_object_category VALUES 
  (1, 'subject'),
  (2, 'isurance_type'),
  (3, 'product');

-- 
-- Вывод данных для таблицы insur_users
--
INSERT INTO insur_users VALUES 
  (1, 'frol', '46f94c8de14fb36680850768ff1b7f2a', 1, 'admin');

-- 
-- Вывод данных для таблицы insur_workers_roles
--
-- Таблица insur_db.insur_workers_roles не содержит данных

-- 
-- Вывод данных для таблицы insur_coworkers
--
-- Таблица insur_db.insur_coworkers не содержит данных

-- 
-- Вывод данных для таблицы insur_insurance_object
--
INSERT INTO insur_insurance_object VALUES 
  (1, 'Главная', 1, NULL, NULL, NULL, NULL),
  (2, 'О компании', 1, NULL, NULL, NULL, NULL),
  (3, 'История', 1, 2, NULL, NULL, NULL),
  (4, 'О корпорации', 1, 2, NULL, NULL, NULL),
  (5, 'Руководство', 1, 2, NULL, NULL, NULL),
  (6, 'Раскрытие информации', 1, 2, NULL, NULL, NULL),
  (7, 'Документ', 1, 6, NULL, NULL, NULL),
  (8, 'Музей страхования', 1, 2, NULL, NULL, NULL),
  (9, 'Вакансии', 1, 2, NULL, NULL, NULL),
  (10, 'Анкета для кондидата', 1, 9, NULL, NULL, NULL),
  (11, 'Новости компании', 1, 2, NULL, NULL, NULL),
  (12, 'Новость', 1, 11, NULL, NULL, NULL),
  (13, 'Контакты', 1, 2, NULL, NULL, NULL),
  (14, 'финансовые показатели', 1, 2, NULL, NULL, NULL),
  (15, 'Новости Страхования', 1, 2, NULL, NULL, NULL),
  (16, 'Новость', 1, 15, NULL, NULL, NULL),
  (17, 'Новость', 1, 15, NULL, NULL, NULL),
  (18, 'Каталог для корпоративных клиентов', 1, NULL, NULL, NULL, NULL),
  (19, 'Готовое решение 1', 1, 18, NULL, NULL, NULL),
  (20, 'Готовое решение 2', 1, 18, NULL, NULL, NULL),
  (21, 'Автострахование', 1, 18, NULL, NULL, NULL),
  (22, 'ДМС', 1, 18, NULL, NULL, NULL),
  (23, 'Если произошел страховой случай', 1, 22, NULL, NULL, NULL),
  (24, 'Полезная информация', 1, 18, NULL, NULL, NULL),
  (25, 'Каталог для малого и среднего бизнеса', 1, NULL, NULL, NULL, NULL),
  (26, 'Строительным компаниям', 1, 25, NULL, NULL, NULL),
  (27, 'Страхование имущества', 1, 26, NULL, NULL, NULL),
  (28, 'Страхование опасных объектов', 1, 26, NULL, NULL, NULL),
  (29, 'Страхование строительно-монтажных работ', 1, 26, NULL, NULL, NULL),
  (30, 'ДМС', 1, 26, NULL, NULL, NULL),
  (31, 'НС', 1, 26, NULL, NULL, NULL),
  (32, 'ВЗР', 1, 26, NULL, NULL, NULL),
  (33, 'Страхование автопарка', 1, 26, NULL, NULL, NULL),
  (34, 'Производственные компании', 1, 25, NULL, NULL, NULL),
  (35, 'Компании перевозчики', 1, 25, NULL, NULL, NULL),
  (36, 'Фармоцевтические компании', 1, 25, NULL, NULL, NULL),
  (37, 'ДМС', 1, 25, NULL, NULL, NULL),
  (38, 'ВЗР', 1, 25, NULL, NULL, NULL),
  (39, 'Автострахование', 1, 25, NULL, NULL, NULL),
  (40, 'Осаго', 1, 40, NULL, NULL, NULL),
  (41, 'Каско', 1, 40, NULL, NULL, NULL),
  (42, 'Полезная информация', 1, 25, NULL, NULL, NULL),
  (43, 'Каталог для физических лиц', 1, NULL, NULL, NULL, NULL),
  (44, 'Автовладельцы', 1, 43, NULL, NULL, NULL),
  (45, 'ГО', 1, 44, NULL, NULL, NULL),
  (46, 'ВЗР', 1, 44, NULL, NULL, NULL),
  (47, 'НС', 1, 44, NULL, NULL, NULL),
  (48, 'ДМС', 1, 44, NULL, NULL, NULL),
  (49, 'Автострахование', 1, 44, NULL, NULL, NULL),
  (50, 'Страхование имущества', 1, 44, NULL, NULL, NULL),
  (51, 'Владельцы недвижимости', 1, 43, NULL, NULL, NULL),
  (52, 'Туристы', 1, 43, NULL, NULL, NULL),
  (53, 'Семья', 1, 43, NULL, NULL, NULL),
  (54, 'Индивидуальный подбор решений', 1, 43, NULL, NULL, NULL),
  (55, 'Взр', 1, 43, NULL, NULL, NULL),
  (56, 'Страхование имущества', 1, 43, NULL, NULL, NULL),
  (57, 'Квартиры', 1, 56, NULL, NULL, NULL),
  (58, 'Калькулятор', 1, 57, NULL, NULL, NULL),
  (59, 'Загородные дома', 1, 56, NULL, NULL, NULL),
  (60, 'Дачи', 1, 56, NULL, NULL, NULL),
  (61, 'Полезная информация', 1, 43, NULL, NULL, NULL),
  (62, 'Партнерам', 1, NULL, NULL, NULL, NULL),
  (63, 'Банкам', 1, 62, NULL, NULL, NULL),
  (64, 'Брокерам', 1, 62, NULL, NULL, NULL),
  (66, 'Меденцинским учреждениям', 1, 62, NULL, NULL, NULL),
  (67, 'Автосалонам', 1, 62, NULL, NULL, NULL),
  (68, 'Отправить заявку', 1, NULL, NULL, NULL, NULL),
  (69, 'Задать вопрос', 1, NULL, NULL, NULL, NULL),
  (70, 'Если произошел страховой случай', 1, NULL, NULL, NULL, NULL);

-- 
-- Вывод данных для таблицы insur_article_content
--
-- Таблица insur_db.insur_article_content не содержит данных

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;