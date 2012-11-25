-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 24.11.2012 19:20:12
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
  place ENUM('outside','inside') DEFAULT NULL COMMENT 'outside - баннер на главной inside - внутри сайта',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1489
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
AVG_ROW_LENGTH = 5461
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
  role_name VARCHAR(45) DEFAULT NULL,
  description VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
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
  id_role INT(11) NOT NULL,
  name_middlename_surname TEXT DEFAULT NULL,
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
  alias VARCHAR(255) DEFAULT NULL,
  category_id INT(11) DEFAULT NULL,
  date_changes DATETIME DEFAULT NULL,
  title VARCHAR(45) NOT NULL COMMENT 'META: title',
  keywords TEXT NOT NULL COMMENT 'META: keywords',
  description TEXT NOT NULL COMMENT 'META: description',
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
  name VARCHAR(255) DEFAULT NULL,
  content LONGTEXT DEFAULT NULL,
  created DATETIME DEFAULT NULL,
  status INT(11) DEFAULT NULL,
  insur_coworkers_id INT(11) DEFAULT NULL,
  object_id INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_insur_article_content_insur_insurance_object_id FOREIGN KEY (object_id)
    REFERENCES insur_insurance_object(id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 17
AVG_ROW_LENGTH = 1365
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
-- Таблица insur_db.insur_article_categories не содержит данных

-- 
-- Вывод данных для таблицы insur_banners
--
INSERT INTO insur_banners VALUES 
  (1, 'upload/img/banner/24.jpg', 'баннер1ateввввв', 'musey_strahovanija', 0, '2012-10-06 15:18:00', 'outside'),
  (2, 'upload/img/banner/IMG_0041.JPG', 'баннер2', 'korporativnym_klientam/gotovoje_reshenije1', 0, '2012-10-06 15:19:24', 'outside'),
  (3, 'upload/img/banner/maska.JPG', 'баннер3', 'malomu_i_srednemu_biznesu/dms25', 0, '2012-10-06 15:20:36', 'outside'),
  (4, 'upload/img/banner/maska.JPG', 'банер4', 'malomu_i_srednemu_biznesu/dms25', 1, '2012-11-21 14:40:38', 'inside'),
  (5, 'upload/img/banner/IMG_0041.JPG', 'банер5', 'korporativnym_klientam/gotovoje_reshenije1', 1, '2012-11-21 14:41:16', 'inside'),
  (6, 'upload/img/banner/IMG_0041.JPG', 'банер6', 'musey_strahovanija', 1, '2012-11-21 14:41:50', 'inside'),
  (7, NULL, 'банер1', NULL, 0, NULL, NULL),
  (8, NULL, 'банер1', NULL, 0, NULL, NULL),
  (9, NULL, 'банер1', NULL, 0, NULL, NULL),
  (10, NULL, 'банер1', NULL, 0, NULL, NULL),
  (11, NULL, 'банер1', NULL, 0, NULL, 'outside');

-- 
-- Вывод данных для таблицы insur_jobs
--
INSERT INTO insur_jobs VALUES 
  (2, 'менеджер', 'пидантичность', 'работать', 'хорошие', 'офис', 'отдел кадров<br>', '2012-11-24 18:04:19', NULL),
  (3, 'sssssss', '', '', '', '', '', '2012-11-24 18:19:22', 0),
  (4, 'sssssss', '', '', '', '', '', '2012-11-24 18:19:43', 1);

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
-- Таблица insur_db.insur_workers_roles не содержит данных

-- 
-- Вывод данных для таблицы users
--
INSERT INTO users VALUES 
  (1, 'frol', '46f94c8de14fb36680850768ff1b7f2a', 1, 'admin');

-- 
-- Вывод данных для таблицы insur_coworkers
--
-- Таблица insur_db.insur_coworkers не содержит данных

-- 
-- Вывод данных для таблицы insur_insurance_object
--
INSERT INTO insur_insurance_object VALUES 
  (1, 'Главная', 1, -1, 'site/index', NULL, '2012-09-28 23:13:40', '', '', ''),
  (2, 'О компании', 1, -1, 'o_kompanii', NULL, '2012-09-28 23:13:40', '', '', ''),
  (3, 'История', 1, 2, 'istorija', NULL, '2012-09-28 23:13:40', '', '', ''),
  (4, 'О корпорации', 1, 2, 'o_korporatzii', NULL, '2012-09-28 23:13:40', '', '', ''),
  (5, 'Руководство', 1, 2, 'rukovodstvo', NULL, '2012-09-28 23:13:40', '', '', ''),
  (6, 'Раскрытие информации', 1, 2, 'raskrytije_informatzii', NULL, '2012-09-28 23:13:40', '', '', ''),
  (7, 'Документ', 1, 6, 'document', NULL, '2012-09-28 23:13:40', '', '', ''),
  (8, 'Музей страхования', 1, 2, 'musey_strahovanija', NULL, '2012-09-28 23:13:40', '', '', ''),
  (9, 'Вакансии', 1, 2, 'vakansiji', NULL, '2012-09-28 23:13:40', '', '', ''),
  (10, 'Анкета для кондидата', 1, 9, 'anketa', NULL, '2012-09-28 23:13:40', '', '', ''),
  (11, 'Новости компании', 1, 2, 'novosti', NULL, '2012-09-28 23:13:40', '', '', ''),
  (12, 'Новость', 1, 11, 'novost1', NULL, '2012-09-28 23:13:40', '', '', ''),
  (13, 'Контакты', 1, 2, 'kontakty', NULL, '2012-09-28 23:13:40', '', '', ''),
  (14, 'Финансовые показатели', 1, 2, 'finansovyje_pokazatli', NULL, '2012-09-28 23:13:40', '', '', ''),
  (15, 'Новости Страхования', 1, 2, 'novosti_strahovanija', NULL, '2012-09-28 23:13:40', '', '', ''),
  (16, 'Новость', 1, 15, 'novost2', NULL, '2012-09-28 23:13:40', '', '', ''),
  (17, 'Новость', 1, 15, 'novost3', NULL, '2012-09-28 23:13:40', '', '', ''),
  (18, 'Корпоративным клиентам', 1, -1, 'korporativnym_klientam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (19, 'Готовое решение 1', 1, 18, 'gotovoje_reshenije1', NULL, '2012-09-28 23:13:40', '', '', ''),
  (20, 'Готовое решение 2', 1, 18, 'gotovoje_reshenije2', NULL, '2012-09-28 23:13:40', '', '', ''),
  (21, 'Автострахование', 1, 18, 'avtostrahovanije18', NULL, '2012-09-28 23:13:40', '', '', ''),
  (22, 'ДМС', 1, 18, 'dms18', NULL, '2012-09-28 23:13:40', '', '', ''),
  (23, 'Если произошел страховой случай', 1, 22, 'strahovoj_sluchaj', NULL, '2012-09-28 23:13:40', '', '', ''),
  (24, 'Полезная информация', 1, 18, 'poleznaja_informatzija18', NULL, '2012-09-28 23:13:40', '', '', ''),
  (25, 'Малому и среднему бизнесу', 1, -1, 'malomu_i_srednemu_biznesu', NULL, '2012-09-28 23:13:40', '', '', ''),
  (26, 'Строительным компаниям', 1, 25, 'stroitelnym_kompanijam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (27, 'Страхование имущества', 1, 26, 'strahovanije_imushestva26', NULL, '2012-09-28 23:13:40', '', '', ''),
  (28, 'Страхование опасных объектов', 1, 26, 'strahovanije_opasyh_objectov', NULL, '2012-09-28 23:13:40', '', '', ''),
  (29, 'Страхование строительно-монтажных работ', 1, 26, 'strahovanije_stroitelno_montazhnyh_rabot', NULL, '2012-09-28 23:13:40', '', '', ''),
  (30, 'ДМС', 1, 26, 'dms26', NULL, '2012-09-28 23:13:40', '', '', ''),
  (31, 'НС', 1, 26, 'ns26', NULL, '2012-09-28 23:13:40', '', '', ''),
  (32, 'ВЗР', 1, 26, 'vzr26', NULL, '2012-09-28 23:13:40', '', '', ''),
  (33, 'Страхование автопарка', 1, 26, 'strahovanije_avtoparka', NULL, '2012-09-28 23:13:40', '', '', ''),
  (34, 'Производственные компании', 1, 25, 'proizvodstvennyje_kompaniji', NULL, '2012-09-28 23:13:40', '', '', ''),
  (35, 'Компании перевозчики', 1, 25, 'kompaniji_perevozchiki', NULL, '2012-09-28 23:13:40', '', '', ''),
  (36, 'Фармоцевтические компании', 1, 25, 'farmazevticheskije_kompaniji', NULL, '2012-09-28 23:13:40', '', '', ''),
  (37, 'ДМС', 1, 25, 'dms25', NULL, '2012-09-28 23:13:40', '', '', ''),
  (38, 'ВЗР', 1, 25, 'vzr25', NULL, '2012-09-28 23:13:40', '', '', ''),
  (39, 'Автострахование', 1, 25, 'avtostrahovanije25', NULL, '2012-09-28 23:13:40', '', '', ''),
  (40, 'ОСАГО', 1, 40, 'osago', NULL, '2012-09-28 23:13:40', '', '', ''),
  (41, 'Каско', 1, 40, 'kasko', NULL, '2012-09-28 23:13:40', '', '', ''),
  (42, 'Полезная информация', 1, 25, 'poleznaja_informatzija25', NULL, '2012-09-28 23:13:40', '', '', ''),
  (43, 'Физическим лицам', 1, -1, 'fizicheskim_litzam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (44, 'Автовладельцы', 1, 43, 'avtovladeltzy', NULL, '2012-09-28 23:13:40', '', '', ''),
  (45, 'ГО', 1, 44, 'go', NULL, '2012-09-28 23:13:40', '', '', ''),
  (46, 'ВЗР', 1, 44, 'vzr44', NULL, '2012-09-28 23:13:40', '', '', ''),
  (47, 'НС', 1, 44, 'ns44', NULL, '2012-09-28 23:13:40', '', '', ''),
  (48, 'ДМС', 1, 44, 'dms44', NULL, '2012-09-28 23:13:40', '', '', ''),
  (49, 'Автострахование', 1, 44, 'avtostrahovanije44', NULL, '2012-09-28 23:13:40', '', '', ''),
  (50, 'Страхование имущества', 1, 44, 'strahovanije_imushestva44', NULL, '2012-09-28 23:13:40', '', '', ''),
  (51, 'Владельцы недвижимости', 1, 43, 'vladeltzy_nedvizhimosti', NULL, '2012-09-28 23:13:40', '', '', ''),
  (52, 'Туристы', 1, 43, 'turisty', NULL, '2012-09-28 23:13:40', '', '', ''),
  (53, 'Семья', 1, 43, 'semja', NULL, '2012-09-28 23:13:40', '', '', ''),
  (54, 'Индивидуальный подбор решений', 1, 43, 'individualnyj_podbor_reshenij', NULL, '2012-09-28 23:13:40', '', '', ''),
  (55, 'ВЗР', 1, 43, 'vzr43', NULL, '2012-09-28 23:13:40', '', '', ''),
  (56, 'Страхование имущества', 1, 43, 'strahovanije_imushestva43', NULL, '2012-09-28 23:13:40', '', '', ''),
  (57, 'Квартиры', 1, 56, 'kvartiry', NULL, '2012-09-28 23:13:40', '', '', ''),
  (58, 'Калькулятор', 1, 57, 'kalkulator', NULL, '2012-09-28 23:13:40', '', '', ''),
  (59, 'Загородные дома', 1, 56, 'zagorodnyje_doma', NULL, '2012-09-28 23:13:40', '', '', ''),
  (60, 'Дачи', 1, 56, 'dachi', NULL, '2012-09-28 23:13:40', '', '', ''),
  (61, 'Полезная информация', 1, 43, 'poleznaja_informatzija43', NULL, '2012-09-28 23:13:40', '', '', ''),
  (62, 'Партнерам', 1, -1, 'partneram', NULL, '2012-09-28 23:13:40', '', '', ''),
  (63, 'Банкам', 1, 62, 'bankam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (64, 'Брокерам', 1, 62, 'brokeram', NULL, '2012-09-28 23:13:40', '', '', ''),
  (66, 'Медицинским учреждениям', 1, 62, 'medicinskim_uchrezhdenijam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (67, 'Автосалонам', 1, 62, 'avtosalonam', NULL, '2012-09-28 23:13:40', '', '', ''),
  (68, 'Отправить заявку', 1, -2, 'site/otpravit_zajavku', NULL, '2012-09-28 23:13:40', '', '', ''),
  (69, 'Задать вопрос', 1, -2, 'site/zadat_vopros', NULL, '2012-09-28 23:13:40', '', '', ''),
  (70, 'Если произошел страховой случай', 1, -2, 'esli_proizoshel_strahovoj_sluchay/', NULL, '2012-09-28 23:13:40', '', '', '');

-- 
-- Вывод данных для таблицы insur_article_content
--
INSERT INTO insur_article_content VALUES 
  (1, 'название статьи', '<p>\r\n\tsssssssssssssssssssss</p>\r\n', '2012-09-29 03:05:02', 1, 0, 44),
  (2, 'название статьи 2', 'вторая тестовая статья', '2012-09-29 15:29:43', 1, 0, 44),
  (7, 'dddddddddddd', '<p>\r\n\tdddddddddddddddddddd</p>\r\n', '2012-10-28 01:10:42', 1, 1, 44),
  (8, 'wwwwwwwwwwwz', '<p>\r\n\tzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz</p>\r\n', '2012-10-28 01:11:24', 1, 1, 44),
  (9, 'qqqqqqqqqqqqqqqqq', '<p>\r\n\twwwwwwwwwwwwwwwwwww</p>\r\n', '2012-10-28 01:18:40', 1, 1, 44),
  (10, 'fffffffffffffff', '<p>\r\n\tddddddddddddd</p>\r\n', '2012-10-28 01:19:26', 1, 1, 44),
  (11, 'ghghghghg', '<p>\r\n\tsdsdsdsdsdsdsd</p>\r\n', '2012-10-29 08:55:33', 1, 1, 44),
  (12, 'ssss', 'dsdsdsds', '2012-11-22 20:56:25', 0, 1, 44),
  (13, 'dsdsdf', 'uyuyu', '2012-11-22 20:56:27', 0, 1, 44),
  (14, 'dfdfdgfhf', 'yuyuyuyu', '2012-11-22 20:56:31', 0, 1, 44),
  (15, 'cbcbvbvnvn', 'hjhjhjhjhj', '2012-11-22 20:56:34', 0, 1, 44),
  (16, 'xcvxcvxcvcxv', 'bnbnbnbnbn', '2012-11-22 20:56:38', 0, 1, 44);

-- 
-- Вывод данных для таблицы insur_article_matrix
--
-- Таблица insur_db.insur_article_matrix не содержит данных

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;