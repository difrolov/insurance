﻿-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 03.12.2012 16:18:03
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
USE sp2all;

-- 
-- Вывод данных для таблицы set_of_notice_groups
--
INSERT INTO set_of_notice_groups VALUES 
  (1, 'Оповещение о новом личном сообщении', NULL, 28, 29),
  (2, 'Участник СП сделал заказ', 11, 11, 12),
  (3, 'В СП добавлен новый товар', 17, 17, NULL),
  (4, 'Вас добавили в друзья', 34, 34, NULL),
  (5, 'Ваша предоплата отмечена полученной', 31, 31, NULL),
  (6, 'Восстановление пароля', NULL, 47, NULL),
  (7, 'Время показа вашего рекламного объявления истекло', 37, 37, NULL),
  (8, 'Добавлена новая встреча', 18, 18, 38),
  (9, 'Заказ отредактирован организатором', 13, 13, NULL),
  (10, 'Заказ отредактирован Участником', 14, 14, NULL),
  (11, 'Заказ удален Оргом', 15, 15, NULL),
  (12, 'Заказ удален Участником', 16, 16, NULL),
  (13, 'Напоминание о встрече Оргу', 24, 24, 39),
  (14, 'Недостаточно купонов. Рассылка СМС прекращена', 25, 25, NULL),
  (15, 'Новый комментарий в обсуждении СП', 40, 40, NULL),
  (16, 'Новый комментарий в обсуждении товара', 41, 41, NULL),
  (17, 'Объявление не прошло модерацию', 44, 44, NULL),
  (18, 'Объявление успешно прошло модерацию', 43, 43, NULL),
  (19, 'Открыта повторная закупка с этого сайта', 30, 30, NULL),
  (20, 'Показ рекламы остановлен Администрацией', 42, 42, NULL),
  (21, 'Регистрация', NULL, 48, NULL),
  (22, 'Сайт на домене. Запрос модерации', 51, 51, NULL),
  (23, 'Сайт на домене. Остановка показа', 54, 54, NULL),
  (24, 'Сайт на домене. Отказ в размещении', 52, 52, NULL),
  (25, 'Сайт на домене. Размещение одобрено', 53, 53, NULL),
  (26, 'СП в Сбор предоплаты', NULL, NULL, 5),
  (27, 'СП отменена Администрацией', 21, 21, NULL),
  (28, 'СП принудительно переведена в статус', 20, 20, NULL),
  (29, 'Товар одобрен Организатором', 36, 36, NULL),
  (30, 'Товар, предложенный в СП, отклонен организатором', 35, 35, NULL),
  (31, 'Уведомление об изменении товара', 49, 49, NULL),
  (32, 'Участник внес предоплату', 8, 8, 9),
  (33, 'Время перевода СП в следующий статус истекает', 19, 19, NULL),
  (34, 'Истекает срок действия подарочного купона', 22, 22, NULL),
  (35, 'СП в следующий статус', 2, 2, NULL),
  (36, 'СП завершена. Карма - Оргу', 10, 10, NULL),
  (37, 'СП завершено. Карма - Участникам', 6, 6, NULL),
  (38, 'Ваш реферал совершил успешную закупку', 33, 33, NULL),
  (39, 'Новый реферальный пользователь', 50, 50, NULL),
  (40, 'СП в следующий статус (Подписка)', 63, 63, NULL),
  (41, 'СП обратно в сбор предоплаты', 7, 7, NULL),
  (42, 'Обслуживание сайта прекращено', NULL, 56, NULL),
  (43, 'Изменена встреча', 57, 57, NULL),
  (44, 'Изменена встреча СМС (только критические изменения)', NULL, NULL, 58),
  (45, 'Отменена встреча', 59, 59, 60),
  (46, 'Новый покупатель в пристрое', 61, 61, NULL),
  (47, 'Партнерский кабинет. Заявка.', 64, 64, NULL),
  (48, 'Уведомление о распродаже', NULL, NULL, 65),
  (49, 'СП отправлена  на модерацию', 66, NULL, NULL),
  (50, 'Запрос модерации объявления', 67, 67, NULL),
  (51, 'Начисление купонов пользователю', 68, 68, NULL),
  (52, 'Снятие купонов с пользователя', 69, 69, NULL),
  (53, 'Письмо с уведомлением на 7 день после регистрации', NULL, 70, NULL),
  (54, 'Приглашение в группы', NULL, 71, NULL),
  (55, 'Восстановление пароля api', NULL, 72, NULL);

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;