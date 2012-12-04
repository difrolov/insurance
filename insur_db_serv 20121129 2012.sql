-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 29.11.2012 20:12:13
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
USE insur_db_serv;

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
-- Описание для таблицы insur_banners
--
DROP TABLE IF EXISTS insur_banners;
CREATE TABLE insur_banners (
  id INT(11) NOT NULL AUTO_INCREMENT,
  src VARCHAR(255) DEFAULT NULL COMMENT 'адрес к изображению',
  name VARCHAR(255) DEFAULT NULL COMMENT 'название баннера сразу под изображением',
  link VARCHAR(255) DEFAULT NULL COMMENT 'ссылка на страницу',
  status INT(11) NOT NULL COMMENT '0- не активен 1-активен',
  date_edit DATETIME DEFAULT NULL COMMENT 'Дата последнего изменения',
  place ENUM('outside','inside','1','2','3','4','5') DEFAULT NULL COMMENT 'outside - баннер на главной inside - внутри сайта',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 15
AVG_ROW_LENGTH = 1365
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_jobs
--
DROP TABLE IF EXISTS insur_jobs;
CREATE TABLE insur_jobs (
  id INT(11) NOT NULL AUTO_INCREMENT,
  jobs_name VARCHAR(255) DEFAULT NULL COMMENT 'наименование вакансии',
  requirements TEXT DEFAULT NULL COMMENT 'требования',
  responsibility TEXT DEFAULT NULL COMMENT 'обязанности',
  terms TEXT DEFAULT NULL COMMENT 'условия',
  job TEXT DEFAULT NULL COMMENT 'Место работы',
  contact_name TEXT DEFAULT NULL COMMENT 'контактное лицо',
  creat_date DATETIME DEFAULT NULL COMMENT 'дата создания',
  status INT(11) DEFAULT NULL COMMENT '1-активна 0-отключено',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы insur_modules
--
DROP TABLE IF EXISTS insur_modules;
CREATE TABLE insur_modules (
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'первичный ключ',
  object_id INT(11) NOT NULL COMMENT 'ID объекта в таблице insur_insurance_object',
  content_id INT(11) DEFAULT NULL COMMENT 'ID статей из таблицы insur_article_categories разделенные "|" если такие имеются',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
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
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы users
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
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
-- Описание для таблицы insur_coworkers
--
DROP TABLE IF EXISTS insur_coworkers;
CREATE TABLE insur_coworkers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name_middlename_surname TEXT DEFAULT NULL COMMENT 'Р¤Р°РјРёР»РёСЏ, РёРјСЏ, РѕС‚С‡РµСЃС‚РІРѕ',
  insur_workers_roles_id INT(11) NOT NULL,
  login VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  status INT(11) NOT NULL,
  role VARCHAR(100) NOT NULL,
  PRIMARY KEY (id, insur_workers_roles_id),
  CONSTRAINT fk_insur_coworkers_insur_workers_roles FOREIGN KEY (insur_workers_roles_id)
    REFERENCES insur_workers_roles(id) ON DELETE NO ACTION ON UPDATE NO ACTION
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 8192
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
  alias VARCHAR(255) DEFAULT NULL,
  category_id INT(11) DEFAULT NULL,
  date_changes DATETIME DEFAULT NULL,
  title VARCHAR(45) NOT NULL COMMENT 'META: title',
  keywords TEXT NOT NULL COMMENT 'META: keywords',
  description TEXT NOT NULL COMMENT 'META: description',
  first_header TEXT NOT NULL COMMENT 'The first header on the page',
  content LONGTEXT NOT NULL COMMENT 'The page content',
  PRIMARY KEY (id),
  UNIQUE INDEX category_id (category_id),
  CONSTRAINT FK_insur_insurance_object_insur_object_category_id FOREIGN KEY (category_id)
    REFERENCES insur_object_category(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 125
AVG_ROW_LENGTH = 442
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
  name VARCHAR(255) NOT NULL,
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
-- Описание для таблицы insur_article_matrix
--
DROP TABLE IF EXISTS insur_article_matrix;
CREATE TABLE insur_article_matrix (
  id INT(11) NOT NULL AUTO_INCREMENT,
  article_category_id INT(11) NOT NULL,
  article_id INT(11) NOT NULL,
  PRIMARY KEY (id, article_category_id, article_id),
  CONSTRAINT fk_insur_article_matrix_insur_article_categories1 FOREIGN KEY (article_category_id)
    REFERENCES insur_article_categories(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_insur_article_matrix_insur_article_content1 FOREIGN KEY (article_id)
    REFERENCES insur_article_content(id) ON DELETE NO ACTION ON UPDATE NO ACTION
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Вывод данных для таблицы insur_article_categories
--
-- Таблица insur_db_serv.insur_article_categories не содержит данных

-- 
-- Вывод данных для таблицы insur_banners
--
INSERT INTO insur_banners VALUES 
  (1, 'upload/img/banner/24.jpg', 'баннер1ateввввв', 'musey_strahovanija', 1, '2012-10-06 15:18:00', 'outside'),
  (2, 'upload/img/banner/IMG_0041.JPG', 'баннер2', 'korporativnym_klientam/gotovoje_reshenije1', 1, '2012-10-06 15:19:24', 'outside'),
  (3, 'upload/img/banner/maska.JPG', 'баннер3', 'malomu_i_srednemu_biznesu/dms25', 1, '2012-10-06 15:20:36', 'outside'),
  (6, 'upload/img/banner/maska.jpg', 'банер6', 'istorija', 1, '2012-11-21 14:41:50', 'inside'),
  (7, NULL, 'банер1', 'vakansiji', 1, NULL, '3'),
  (8, NULL, 'банер1', NULL, 1, NULL, '3'),
  (9, NULL, 'банер1', NULL, 1, NULL, '3'),
  (10, NULL, 'банер1', NULL, 0, NULL, NULL),
  (11, NULL, 'банер1', 'istorija', 1, NULL, '4'),
  (12, NULL, 'банер1', NULL, 0, NULL, 'outside'),
  (13, NULL, 'банер1', NULL, 0, NULL, 'outside'),
  (14, NULL, 'банер1', NULL, 0, NULL, 'outside');

-- 
-- Вывод данных для таблицы insur_jobs
--
-- Таблица insur_db_serv.insur_jobs не содержит данных

-- 
-- Вывод данных для таблицы insur_modules
--
INSERT INTO insur_modules VALUES 
  (1, 12, NULL),
  (2, 19, NULL),
  (3, 20, NULL);

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
INSERT INTO insur_workers_roles VALUES 
  (1, 'boss', 'Руководитель');

-- 
-- Вывод данных для таблицы users
--
INSERT INTO users VALUES 
  (1, 'frol', '46f94c8de14fb36680850768ff1b7f2a', 1, 'admin');

-- 
-- Вывод данных для таблицы insur_coworkers
--
INSERT INTO insur_coworkers VALUES 
  (1, 'srgg', 1, '', '', 0, ''),
  (3, NULL, 1, 'frol', '46f94c8de14fb36680850768ff1b7f2a', 1, 'admin');

-- 
-- Вывод данных для таблицы insur_insurance_object
--
INSERT INTO insur_insurance_object VALUES 
  (1, 'Главная', 1, -1, 'site/index', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (2, 'О компании', 1, -1, 'o_kompanii', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (4, 'О корпорации', 1, 2, 'o_korporatzii', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (6, 'Раскрытие информации', 1, 2, 'raskrytije_informatzii', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (7, 'Документ', 0, 6, 'document', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (9, 'Вакансии', 1, 2, 'vakansiji', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (10, 'Анкета для кондидата', 1, 9, 'anketa', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (11, 'Новости компании', 0, 2, 'novosti', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (12, 'Новость', 1, 11, 'novost1', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (13, 'Контакты', 1, 2, 'kontakty', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (14, 'Финансовые показатели', 0, 2, 'finansovyje_pokazatli', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (15, 'Новости Страхования', 0, 2, 'novosti_strahovanija', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (16, 'Новость', 1, 15, 'novost2', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (17, 'Новость', 1, 15, 'novost3', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (18, 'Корпоративным клиентам', 1, -1, 'korporativnym_klientam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (23, 'Если произошел страховой случай', 1, 22, 'strahovoj_sluchaj', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (25, 'Малому и среднему бизнесу', 1, -1, 'malomu_i_srednemu_biznesu', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (26, 'Строительным компаниям', 0, 25, 'stroitelnym_kompanijam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (27, 'Страхование имущества', 0, 26, 'strahovanije_imushestva26', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (28, 'Страхование опасных объектов', 0, 26, 'strahovanije_opasyh_objectov', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (29, 'Страхование строительно-монтажных работ', 0, 26, 'strahovanije_stroitelno_montazhnyh_rabot', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (30, 'ДМС', 0, 26, 'dms26', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (31, 'НС', 0, 26, 'ns26', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (32, 'ВЗР', 0, 26, 'vzr26', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (33, 'Страхование автопарка', 0, 26, 'strahovanije_avtoparka', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (34, 'Производственные компании', 0, 25, 'proizvodstvennyje_kompaniji', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (35, 'Компании перевозчики', 0, 25, 'kompaniji_perevozchiki', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (36, 'Фармоцевтические компании', 0, 25, 'farmazevticheskije_kompaniji', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (37, 'ДМС', 0, 25, 'dms25', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (38, 'ВЗР', 0, 25, 'vzr25', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (39, 'Автострахование', 0, 25, 'avtostrahovanije25', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (40, 'ОСАГО', 1, 40, 'osago', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (41, 'Каско', 1, 40, 'kasko', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (42, 'Полезная информация', 0, 25, 'poleznaja_informatzija25', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (43, 'Частным клиентам', 1, -1, 'fizicheskim_litzam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (44, 'Автовладельцы', 0, 43, 'avtovladeltzy', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (45, 'ГО', 0, 44, 'go', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (46, 'ВЗР', 0, 44, 'vzr44', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (47, 'НС', 0, 44, 'ns44', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (48, 'ДМС', 0, 44, 'dms44', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (49, 'Автострахование', 0, 44, 'avtostrahovanije44', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (50, 'Страхование имущества', 0, 44, 'strahovanije_imushestva44', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (51, 'Владельцы недвижимости', 0, 43, 'vladeltzy_nedvizhimosti', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (52, 'Туристы', 0, 43, 'turisty', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (53, 'Семья', 0, 43, 'semja', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (54, 'Индивидуальный подбор решений', 0, 43, 'individualnyj_podbor_reshenij', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (55, 'ВЗР', 0, 43, 'vzr43', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (56, 'Страхование имущества', 0, 43, 'strahovanije_imushestva43', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (57, 'Квартиры', 0, 56, 'kvartiry', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (58, 'Калькулятор', 1, 57, 'kalkulator', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (59, 'Загородные дома', 0, 56, 'zagorodnyje_doma', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (60, 'Дачи', 0, 56, 'dachi', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (61, 'Полезная информация', 0, 43, 'poleznaja_informatzija43', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (62, 'Партнерам', 1, -1, 'partneram', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (63, 'Банкам', 1, 62, 'bankam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (64, 'Брокерам', 0, 62, 'brokeram', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (66, 'Медицинским учреждениям', 0, 62, 'medicinskim_uchrezhdenijam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (67, 'Автосалонам', 1, 62, 'avtosalonam', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (68, 'Отправить заявку', 1, -2, 'site/otpravit_zajavku', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (69, 'Задать вопрос', 1, -2, 'site/zadat_vopros', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (70, 'Если произошел страховой случай', 1, -2, 'esli_proizoshel_strahovoj_sluchay/', NULL, '2012-09-28 23:13:40', '', '', '', '', ''),
  (71, 'dfsdfdsf', 0, 6, 'dfsdfsd', NULL, '2012-11-27 01:20:51', '', 'dfdsfds', 'dfdsf', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (72, 'dfsdfdsf', 0, 6, 'symbols', NULL, '2012-11-27 01:25:07', '', 'а потом', 'тоже потом', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:4:{i:0;s:14:"Новость";i:1;s:14:"Новость";i:2;s:14:"Новость";i:3;s:14:"Новость";}}}'),
  (73, 'О компании', 0, 2, 'o_kompanii_', NULL, '2012-11-27 01:30:33', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (74, 'Клиенты компании', 1, 2, 'klienti_kompanii', NULL, '2012-11-27 01:34:37', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (75, 'Партнеры компании', 1, 2, 'partneri_kompanii', NULL, '2012-11-27 01:38:03', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (76, 'Новости компании', 1, 2, 'novosti_kompanii', NULL, '2012-11-27 01:40:26', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (77, 'Новости компании', 0, 2, 'novosti_kompanii', NULL, '2012-11-27 01:40:47', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (78, 'Новости компании', 0, 2, 'novosti_kompanii', NULL, '2012-11-27 01:41:03', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (79, 'Новости компании', 0, 2, 'novosti_kompanii', NULL, '2012-11-27 01:41:09', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (80, 'Здоровье', 0, 18, 'zdorovie', NULL, '2012-11-27 01:43:40', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:14:"Новость";}}}'),
  (81, 'Про связи', 0, 2, 'conn', NULL, '2012-11-27 01:48:19', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 10";}}}'),
  (82, 'Про прошлое', 0, 4, 'bylo', NULL, '2012-11-27 01:57:47', '', 'когда', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 11";}}}'),
  (83, 'О компании', 0, 2, 'o_kompanii_', NULL, '2012-11-27 02:17:19', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 12";}}}'),
  (84, 'О компании', 1, 2, 'o_kompanii_oc', NULL, '2012-11-27 02:20:00', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 13";}}}'),
  (85, 'Здоровье', 1, 18, 'zdorovie_', NULL, '2012-11-27 02:23:08', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 14";}}}'),
  (86, 'Добровольное медицинское страхование', 1, 85, 'dobrovolnoe_medicinskoe_strahovanie_kk', NULL, '2012-11-27 02:26:04', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 15";}}}'),
  (87, 'Страхование от несчастных случае в и болезней', 1, 85, 'strahovanie_ot_neschastnih_sluchaev_i_bolezhei', NULL, '2012-11-27 02:31:15', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 16";}}}'),
  (88, 'Страхование выезжающих за рубеж', 1, 85, 'strahovanie_viezgauschih_za_rubeg', NULL, '2012-11-27 02:34:07', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 17";}}}'),
  (89, 'Транспорт', 1, 18, 'transport', NULL, '2012-11-27 02:36:16', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 18";}}}'),
  (90, 'Имущество', 1, 18, 'imuschestvo', NULL, '2012-11-27 02:39:33', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 19";}}}'),
  (91, 'Ответственность', 1, 18, 'otvetstvennost', NULL, '2012-11-27 02:41:35', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 20";}}}'),
  (92, 'Гражданская ответственность', 1, 91, 'gragdanskaay_otvetstvennost', NULL, '2012-11-27 02:44:22', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 21";}}}'),
  (93, 'Правовая ответственность ', 1, 91, 'pravovaay_otvetstvennost', NULL, '2012-11-27 02:46:37', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 22";}}}'),
  (94, 'Строительно - монтажные работы', 1, 18, 'stroitelno_montagnie_raboti', NULL, '2012-11-27 02:48:34', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 23";}}}'),
  (95, 'Грузы', 1, 18, 'gruzi', NULL, '2012-11-27 02:49:52', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 24";}}}'),
  (96, 'Особо опасные объекты', 1, 18, 'osobo_opasnie_obekti', NULL, '2012-11-27 02:51:58', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 25";}}}'),
  (97, 'Автострахование', 1, 43, 'avtostrahovanie', NULL, '2012-11-27 02:53:53', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 26";}}}'),
  (98, 'КАСКО', 1, 97, 'kasko_', NULL, '2012-11-27 02:55:26', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 27";}}}'),
  (99, 'ОСАГО+', 1, 97, 'osago_', NULL, '2012-11-27 02:56:45', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 28";}}}'),
  (100, 'Здоровье', 1, 43, 'zdorovie_ch', NULL, '2012-11-27 02:58:07', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 29";}}}'),
  (101, 'Добровольное медицинское страхование', 1, 43, 'dobrovolnoe_medicinskoe_strahovanie_', NULL, '2012-11-27 03:00:19', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 30";}}}'),
  (102, 'Страхование от несчастных случаев и болезней', 1, 43, 'strahovanie_ot_neschastnih_sluchaev_i_boleznei', NULL, '2012-11-27 03:02:44', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 31";}}}'),
  (103, 'Имущество', 1, 43, 'imuschestvo_ch', NULL, '2012-11-27 03:04:23', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 32";}}}'),
  (104, 'Страхование квартиры', 1, 103, 'strahovanie_kvartiri', NULL, '2012-11-27 03:05:59', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 33";}}}'),
  (105, 'Страхование дома', 1, 103, 'strahovanie_doma', NULL, '2012-11-27 03:07:52', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 34";}}}'),
  (106, 'Путешествие ', 1, 43, 'puteshestvie', NULL, '2012-11-27 03:09:32', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 35";}}}'),
  (107, 'Страхование выезжающих за рубеж', 1, 106, 'strahovanie_viezgauschih_za_rubeg_ch', NULL, '2012-11-27 03:11:59', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 36";}}}'),
  (108, 'Банковское страхование', 1, 43, 'bankovskoe_strahovanie', NULL, '2012-11-27 03:13:33', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 37";}}}'),
  (109, 'Для клиентов коммерческих банков', 1, 108, 'dlay_klientov_kommercheskih_bankov', NULL, '2012-11-27 03:15:50', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 38";}}}'),
  (110, 'Для клиентов банка "Открытие"', 1, 108, 'dlay_klientov_banka_otkritie', NULL, '2012-11-27 03:17:55', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 39";}}}'),
  (111, 'Торговым сетям', 1, 62, 'torgovim_setaym', NULL, '2012-11-27 03:20:54', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 40";}}}'),
  (112, 'Страховым брокерам', 1, 62, 'strahovim_brokeram', NULL, '2012-11-27 03:22:33', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 41";}}}'),
  (113, 'Лечебно-профилактическим учреждениям ', 1, 62, 'lechebno_profilakticheskim_uchregdeniaym', NULL, '2012-11-27 03:24:48', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 42";}}}'),
  (114, 'Здоровье', 1, 25, 'zdorovie_msb', NULL, '2012-11-27 09:54:38', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 43";}}}'),
  (115, 'Добровольное медицинское страхование', 1, 114, 'dobrovolnoe_medisinskoe_strahovanie', NULL, '2012-11-27 09:57:44', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 44";}}}'),
  (116, 'Страхование от несчастных случаев и болезней', 1, 114, 'strahovanie_ot_neschastnih_sluchaev_i_boleznei_msb', NULL, '2012-11-27 10:00:16', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 45";}}}'),
  (117, 'Страхование выезжающих за рубеж', 1, 114, 'strahovanie_viizgausih_za_rubeg_msb', NULL, '2012-11-27 10:04:14', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 46";}}}'),
  (118, 'Транспорт', 1, 25, 'transport_msb', NULL, '2012-11-27 10:05:37', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 47";}}}'),
  (119, 'Имущество', 1, 25, 'imuschestvo_msb', NULL, '2012-11-27 10:07:08', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 48";}}}'),
  (120, 'Ответсвенность', 1, 25, 'otvetstvennost_msb', NULL, '2012-11-27 10:08:44', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 49";}}}'),
  (121, 'Строительно-монтажные работы', 1, 25, 'stroitelno_montagnie_raboti_msb', NULL, '2012-11-27 10:11:36', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 50";}}}'),
  (122, 'Грузы', 1, 25, 'gruzi_msb', NULL, '2012-11-27 10:13:11', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 51";}}}'),
  (123, 'Особо опасные объекты', 1, 25, 'osobo_opasnie_obekti_msb', NULL, '2012-11-27 10:15:20', '', '', '', '', 'a:2:{s:6:"Schema";s:3:"100";s:6:"blocks";a:1:{i:1;a:1:{i:0;s:28:"Текст :: article id: 52";}}}'),
  (124, 'Виды разного страхования', 1, 25, 'insur_species', NULL, '2012-11-29 00:00:48', 'Виды страхования, как они есть', 'страх ужос боязнь', 'Взял из вики. Но это ж временно!', '', 'a:2:{s:6:"Schema";s:3:"300";s:6:"blocks";a:3:{i:1;a:3:{i:0;s:14:"Новость";i:1;s:28:"Текст :: article id: 22";i:2;s:28:"Текст :: article id: 53";}i:2;a:4:{i:0;s:14:"Новость";i:1;s:14:"Новость";i:2;s:14:"Новость";i:3;s:28:"Текст :: article id: 54";}i:3;a:3:{i:0;s:14:"Новость";i:1;s:14:"Новость";i:2;s:28:"Текст :: article id: 11";}}}');

-- 
-- Вывод данных для таблицы insur_article_content
--
-- Таблица insur_db_serv.insur_article_content не содержит данных

-- 
-- Вывод данных для таблицы insur_article_matrix
--
-- Таблица insur_db_serv.insur_article_matrix не содержит данных

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;