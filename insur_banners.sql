-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 29.11.2012 2:51:36
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
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;