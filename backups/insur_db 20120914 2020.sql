-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 14.09.2012 20:20:21
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
-- Описание для таблицы insur_insurance_products
--
DROP TABLE IF EXISTS insur_insurance_products;
CREATE TABLE insur_insurance_products (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  status INT(11) DEFAULT 0,
  parent_id INT(11) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_subject_of_insurance
--
DROP TABLE IF EXISTS insur_subject_of_insurance;
CREATE TABLE insur_subject_of_insurance (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  status INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
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
-- Описание для таблицы insur_insurance_products_matrix
--
DROP TABLE IF EXISTS insur_insurance_products_matrix;
CREATE TABLE insur_insurance_products_matrix (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_parent_product INT(11) NOT NULL,
  id_product INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_insur_insurance_products_matrix_insur_insurance_products_id FOREIGN KEY (id_parent_product)
    REFERENCES insur_insurance_products(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_set_for_subjects_matrix
--
DROP TABLE IF EXISTS insur_set_for_subjects_matrix;
CREATE TABLE insur_set_for_subjects_matrix (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_subject INT(11) NOT NULL,
  id_product INT(11) NOT NULL,
  PRIMARY KEY (id, id_product, id_subject),
  CONSTRAINT FK_set_for_subjects_matrix_insur_insurance_products_id FOREIGN KEY (id_product)
    REFERENCES insur_insurance_products(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_set_for_subjects_matrix_insur_subject_of_insurance_id FOREIGN KEY (id_subject)
    REFERENCES insur_subject_of_insurance(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_set_of_products_matrix
--
DROP TABLE IF EXISTS insur_set_of_products_matrix;
CREATE TABLE insur_set_of_products_matrix (
  id INT(11) NOT NULL AUTO_INCREMENT,
  product_id INT(11) NOT NULL,
  article_id INT(11) NOT NULL,
  PRIMARY KEY (id, product_id, article_id),
  INDEX fk_insur_article_matrix_insur_article_categories1 (product_id),
  INDEX fk_insur_article_matrix_insur_article_content1 (article_id),
  CONSTRAINT FK_insur_set_of_products_matrix_insur_insurance_products_id FOREIGN KEY (product_id)
    REFERENCES insur_insurance_products(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
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
  PRIMARY KEY (id, insur_coworkers_id),
  CONSTRAINT fk_insur_article_content_insur_coworkers1 FOREIGN KEY (insur_coworkers_id)
    REFERENCES insur_coworkers(id) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Вывод данных для таблицы insur_insurance_products
--
-- Таблица insur_db.insur_insurance_products не содержит данных

-- 
-- Вывод данных для таблицы insur_subject_of_insurance
--
-- Таблица insur_db.insur_subject_of_insurance не содержит данных

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
-- Вывод данных для таблицы insur_insurance_products_matrix
--
-- Таблица insur_db.insur_insurance_products_matrix не содержит данных

-- 
-- Вывод данных для таблицы insur_set_for_subjects_matrix
--
-- Таблица insur_db.insur_set_for_subjects_matrix не содержит данных

-- 
-- Вывод данных для таблицы insur_set_of_products_matrix
--
-- Таблица insur_db.insur_set_of_products_matrix не содержит данных

-- 
-- Вывод данных для таблицы insur_article_content
--
-- Таблица insur_db.insur_article_content не содержит данных

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;