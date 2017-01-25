# Test REST Blog

Комменты.

1. В задании не совпадают поля в запросах и базе. Это специальная фишка? :)
С атрибутом Post_type я разрулил мутатором и аксессором. Если нужно, можно и остальные так же сделать.

2. Я не стал использовать встроенный в laravel функционал для построения api. Он слишком сложен для этой задачи. Было проще релизовать простой Midlewere + атрибут у User для авторизации по токену при каждом запросе.

3. Получение токенов написал по TDD, остальное - нет. Задача простая, + лень :)

4. Запускал сервис через docker-compose в контейнерах. (см. папку docker ). 
Для старта. В папке docker
docker-compose up

docker exec -t -i docker_web_1 php composer.phar install

docker exec -t -i docker_web_1 vendor/phpunit/phpunit/phpunit

5. Сервис тестил в Paw. В папке tests есть тест. (только для маков)




# Задание

Разработать тестовый json rpc сервер для управление личным блогом

Стек технологий

PHP 5.6
Фреймворк, например, laravel 5.2


Основные методы
Auth ( авторизация)
Параметры 
email 
password 
 Ответ:  token 
Далее, при любом взаимодействии с сервером, будем использовать его, как идентификатор пользователя.

2) ListPosts ( получить список постов пользователя)
Параметры 
token 
On_page ( сколько постов на страницу)
Order_by (id , title, created_at)
Order_direction ( asc \ desc ) 
Post_type ( post \ draft) черновик или уже опубликованный пост

Ответ : json с записями

3) AddPost ( добавить пост )
Token
Title
Created_at ( автоматом текущее время или переданное через api )
Content
Post_type

4) EditPost ( редактировать пост)
Token
Title
Created_at ( автоматом текущее время или переданное через api )
Content
Post_type

Автоматом обновляем updated_at

5) deletePost ( удаляем пост )
Token
post_id


Используем так называемый soft delete.


Желаемая таблица для хранения данных:


CREATE TABLE `Items` (
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
 `is_development_mode` tinyint(1) NOT NULL,  
  `class` varchar(255) NOT NULL,
  `order_id` int(10) NOT NULL DEFAULT '0',
  `props_json` mediumtext,
  `created_ts` timestamp NOT NULL DEFAULT '1970-01-01 00:00:01',
  `updated_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_ts` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`item_id`,`is_development_mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='2';


Коммент
Is_development_mode =1 - если опубликовано
Is_development_mode = 0 - если черновик

Содержимое поста subject \ content храним в json в поле props_json


Результат залить как репозиторий на bitbucket.org или github
