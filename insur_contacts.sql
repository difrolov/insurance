-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 06.12.2012 22:17:42
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
-- Вывод данных для таблицы insur_contacts
--
INSERT INTO insur_contacts VALUES 
  (1, 'Москва', 'Москва ул. Тверская д.1', '79094001011', 0, '2012-12-05 00:57:13', NULL, NULL, NULL);

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;