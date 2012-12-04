-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.97.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 03.12.2012 17:37:38
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
-- Вывод данных для таблицы api_methods
--
INSERT INTO api_methods VALUES 
  (1, 'system', 'getApiList', 'Получить список методов API', 'Возвращает список доступных методов API с описанием параметров', 1, 'get_api_list.php', 0, 0),
  (2, 'user', 'registr', 'Регистрация нового пользователя', 'Метод позволяет зарегистрировать нового пользователя. Полезен для партнёрских сайтов, желающих создать свою собственную страницу регистрации. Предполагается, что партнёр, использующий этот метод, сделал защиту от множественных и фальшивых регистраций методом CAPTCHA или подобным, и получил согласие пользователя с нашими условиями оказания услуг.<br>\r\nПример использования метода, реализован на php:<br>\r\n$request_params = Array(<br>\r\n\t\t''login''=>''ivanov''<br>\r\n\t\t''password''=>''123qwe123'' //если не передан то генерируется автоматически <br>\r\n\t\t''email_confirm''=1 // для подтверждения email без отправки письма<br>\r\n\t\t''birthday''=>''1987.01.01'',<br>\r\n\t\t''email''=>''d.i.frolov@yandex.ru'',<br>\r\n\t\t''last_name''=>''popovith'',<br>\r\n\t\t''m''=>''registr'',<br>\r\n\t\t''name''=>''dmitry'',<br>\r\n\t\t''phone''=>''7909.......'',<br>\r\n\t\t''surname''=>''ivanov'',<br>\r\n);<br>\r\n $request_params[''upload_ava'']=''@E:\\3sbrMoL6fFk.jpg''; //картинка на аватарку<br>\r\n\t \t$ch = curl_init();<br>\r\n\t\tcurl_setopt($ch, CURLOPT_URL, ''http://api.sp2all.ru'');<br>\r\n\t\tcurl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_POST, 1);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_POSTFIELDS, $request_params);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);<br>\r\n\t\t$s = curl_exec($ch);<br>\r\n\t\tcurl_close($ch);<br>', 1, 'registr.php', 0, 0),
  (3, 'user', 'login', 'Авторизация на сайте', 'Авторизация на сайте. В случае успешной авторизации возвращает uid пользователя и key - ключ для подписи API запросов', 1, 'login.php', 0, 0),
  (4, 'user', 'logout', 'Выход', 'Выход с сайта', 1, 'logout.php', 2, 0),
  (5, 'system', 'getSysCounters', 'Получить счетчики', 'Возвращает список счетчиков сисемы: Количество зарегистрированных пользователей, Количество организаторов, Количество закупок, Количество товаров', 1, 'get_system_counters.php', 0, 3600),
  (6, 'system', 'getCity', 'Возвращает текущий город пользователя по IP', 'Возвращает текущий город пользователя по IP', 1, 'get_city.php', 0, 0),
  (7, 'system', 'getRegionList', 'получить список регионов', 'Возвращает список более мелких региональных объектов. Если не задан параметр поиска, возвращает список стран.', 1, 'get_region_list.php', 0, 0),
  (8, 'sp', 'getSPInfo', 'Получение данных о СП', '', 1, 'get_sp_info.php', 1, 0),
  (9, 'sp', 'addComment', 'Написать комментарий', 'Добавляет новый коментрий к данному объекту', 1, 'add_comment.php', 2, 0),
  (10, 'sp', 'getComments', 'Получение комментарев', 'Возвращает список коментраев к данному объекту', 1, 'get_comments.php', 2, 0),
  (11, 'sp', 'getSPList', 'Получение списка СП', '', 1, 'get_sp_list.php', 1, 0),
  (12, 'sp', 'getProductList', 'Получение списка СП-Продуктов', 'Возвращает список сп продуктов по СП либо товарной категории. Выбирает товары для города определенного параметрами:city, area,country,ip', 1, 'get_product_list.php', 1, 0),
  (13, 'sp', 'getProductInfo', 'Получение информации о СП-Продукте', 'Возвращает полную нформацию о выбранном продукте', 1, 'get_product_info.php', 1, 0),
  (14, 'user', 'checkUserExists', 'Проверка существование пользователя', 'Позволяет проверить существование пользователя по логину/email/телефону.', 1, 'check_user_exists.php', 0, 0),
  (15, 'user', 'getUserInfo', 'Информация о пользователе', 'Возвращиает полную информацию о пользователе', 1, 'get_user_info.php', 1, 0),
  (16, 'user', 'getUserCounters', 'Счетчики пользователя', 'Возвращиает основные счетчики пользователя (Количество купонов, сообщений, уведомлений)', 1, 'get_user_counters.php', 2, 600),
  (17, 'org', 'getOrgSPList', 'Я - организатор. Получение списка СП.', 'Возвращает список СП в которых данный пользователь яляется организаторм', 1, 'get_org_sp_list.php', 2, 0),
  (18, 'org', 'getOrgPoductList', 'Я - организатор. Получение списка продуктов.', 'Возвращает список СП-Продуктов в которых данный пользователь яляется организаторм', 1, 'get_org_product_list.php', 2, 0),
  (19, 'org', 'getOrgHolds', 'Я - организатор. Заказы', 'Получить список заказанных товаров у пользователя', 1, 'get_org_holds.php', 2, 0),
  (20, 'customer', 'getCustomerSPList', 'Я - покупатель. Получение списка СП', '', 1, 'get_customer_sp_list.php', 2, 0),
  (21, 'customer', 'getCustomerHolds', 'Я - покупатель. Заказы', 'Получить список заказанных товаров СП', 1, 'get_customer_holds.php', 2, 0),
  (22, 'customer', 'createOrder', 'Заказать товар', 'Заказать товар', 1, 'create_order.php', 2, 0),
  (23, 'user', 'addFavorites', 'Отправить в избранное', 'Отправить товар в избранное', 1, 'to_favorites.php', 2, 0),
  (24, 'user', 'delFavorites', 'Удалить из избранного', 'Удалить из избранного', 1, 'del_favorites.php', 2, 0),
  (25, 'user', 'getFavoritesList', 'Получение списка избранное', 'Получение списка объектов, добавленных в избранное', 1, 'get_favorites.php', 2, 0),
  (26, 'user', 'getMessages', 'Получить личные сообщения', 'Возвращает список личных сообщений и оповещений', 1, 'get_messages.php', 2, 0),
  (27, 'user', 'addMessage', 'Отправляет личное сообщение', 'Отправка личного сообщения, перепесчику', 1, 'add_messages.php', 2, 0),
  (28, 'system', 'exportApiMethod', 'а­аКбаПаОбб аМаЕбаОаДаА', '', 2, 'export_api_method.php', 2, 0),
  (29, 'user', 'getProfile', 'Мой профиль', 'Возвращиает полную информацию обо мне', 1, 'get_profile.php', 2, 0),
  (30, 'user', 'readMessages', 'Прочитать сообщение', 'Помечает сообшения как прочитанные', 1, 'read_messages.php', 2, 0),
  (31, 'user', 'delMessages', 'Удалить сообщение', '', 1, 'del_messages.php', 2, 0),
  (32, 'user', 'unreadMessages', 'Пометить сообщение не прочитанным', 'Помечает сообшения как не прочитанные', 1, 'unread_messages.php', 2, 0),
  (33, 'user', 'CheckPhone', 'Проверка на совпадения привязанных телефонов', 'Проверяет телефон на совподения и если они есть возвращает юзера с привязанным телефоном', 1, 'confirm_phone.php', 2, 0),
  (34, 'user', 'CheckEmail', 'Проверка на совпадения привязанных почтовых ящико', 'Проверяет почтовый ящик на совподения и если они есть возвращает юзера с привязанным телефоном', 1, 'confirm_email.php', 2, 0),
  (35, 'user', 'sendSms', 'Отправка смс пользователем', 'Пользователь имеет возможность отправить смс за свой счет', 1, 'send_sms.php', 2, 0),
  (36, 'system', 'getCatalog', 'Получение списка категорий товаров', 'Получение списка категорий товаров', 1, 'get_catalog.php', 0, 0),
  (37, 'user', 'UserPhoneConfirm', 'Подтверждение тел пользователем', 'Подтверждение тел пользователем<br>\r\nПример использования метода, реализован на php:<br>\r\n$request_params = Array(<br/>\r\n\t\t''uid''\t\t=>\t3,<br/>\r\n\t\t''m''\t=>\t''UserPhoneConfirm'',<br/>\r\n\t\t''phone''=>''7909.......'',<br/>\r\n\t\t''code'' =>''xxxxxx'' // при запросе кода этот параметр передавать не нужно<br/>\r\n);<br/>\r\nksort($request_params);<br/>\r\n$params = '''';<br/>\r\nforeach ($request_params as $key => $value) {<br/>\r\n\t$params .= "&$key=$value";<br/>\r\n}<br/>\r\n//В модели сервер-сервер подпись выглядит так<br/>\r\n$crc = md5(''Тут api_key'' пользователя.$params);<br/>\r\n$curl = curl_init(''http://api.sp2all.ru?m=UserPhoneConfirm&uid=3&crc=''.$crc.''&phone=7909.......&uid=3&code=xxxxxx'');<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_HEADER, 0);<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_RETURNTRANSFER, true);<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_TIMEOUT, 30);<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_COOKIEJAR, $_SERVER[''DOCUMENT_ROOT''].''/cookie.txt'');<br/>\r\n\t\t//отсылаем серверу COOKIE полученные от него при авторизации<br/>\r\n\t\tcurl_setopt($curl, CURLOPT_COOKIEFILE, $_SERVER[''DOCUMENT_ROOT''].''/cookie.txt'');<br/>\r\n\t\t$s = curl_exec($curl);<br/>\r\n\t\tcurl_close($curl);<br/>', 1, 'user_phone_confirm.php', 2, 0),
  (38, 'user', 'UpdateProfile', 'Редактирование профиля', 'Редактирование профиля\r\nПример, реализованный на PHP:\r\nПример, реализованный на PHP:\r\n// если пользователь участвовал хоть в одной закупке,<br>\r\n//то следующие поля являются обязательными<br>\r\n//"name"<br>\r\n//"last_name"<br>\r\n//"surname"<br>\r\n//"city_id"<br>\r\n//"phone"<br>\r\n\r\n$request_params = Array(<br>\r\n\t\t''email_confirm''=1 // для подтверждения email без отправки письма<br>\r\n\t\t''birthday''=>''1987.01.01'',<br>\r\n\t\t''last_name''=>''popovith'',<br>\r\n\t\t''m''=>''UpdateProfile'',<br>\r\n\t\t''name''=>''dmitry'',<br>\r\n\t\t''phone''=>''79094229462'',<br>\r\n\t\t''surname''=>''krilov'',<br>\r\n\t\t''city''=>''3'',<br>\r\n\t\t''uid''=>''15093'',<br>\r\n);<br>\r\nksort($request_params);<br>\r\n$params = '''';<br>\r\nforeach ($request_params as $key => $value) {<br>\r\n\t$params .= "&$key=$value";<br>\r\n}<br>\r\n$crc = md5(''Тут api_key пользователя''.$params); <br>\r\n$request_params[''crc'']=$crc;<br>\r\n$request_params[''upload_ava'']=''@E:\\3sbrMoL6fFk.jpg''; //картинка на аватарку<br>\r\n\t \t$ch = curl_init();<br>\r\n\t\tcurl_setopt($ch, CURLOPT_URL, ''http://api.sp2all.ru'');<br>\r\n\t\tcurl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_POST, 1);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_POSTFIELDS, $request_params);<br>\r\n\t\tcurl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);<br>\r\n\t\t$s = curl_exec($ch);<br>\r\n\t\tcurl_close($ch);<br>\r\n', 1, 'registr.php', 2, 0),
  (39, 'system', 'getHelpList', 'Оглавление справки', 'Возвращает список всех разделов справки', 1, 'get_help_list.php', 0, 0),
  (40, 'system', 'getHelp', 'Вызов справки', 'Возвращает текст справки', 1, 'get_help.php', 0, 0),
  (41, 'customer', 'delOrder', 'Удаление заказа пользователем', 'Удаление заказа пользователем своего заказа', 1, 'del_order.php', 2, 0),
  (42, 'user', 'restoreMessages', 'Восстановить личные сообщения', 'Восстанавливает личные сообщения', 1, 'restore_msg.php', 2, 0),
  (43, 'user', 'getPasswordReminder', 'Запрос восстановление пароля', 'запрос восстановления пароля', 1, 'password_reminder.php', 0, 0),
  (44, 'user', 'setPasswordReminder', 'Новый пароль', 'обновляет пароль пользователю', 1, 'password_reminder.php', 0, 0);

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;