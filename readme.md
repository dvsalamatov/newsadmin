# Пример простой реализации CRUD

Реализовать админку для управления списком новостей: создание, редактирование, удаление

Предусмотреть ограничение: пользователь не может управлять новостями, которые были созданы другими пользователями.

## Запуск сборки

Для запуска сборки необходимо установить: docker и docker-compose.

Склонируйте репозиторий и из корня проекта выполните следующие команды:
 
- `cp .env.dist .env`  
- `docker-compose up -d --build`
- `docker exec -it api_php composer install`
- `docker exec -it api_php php yii migrate`

Сайт доступен по адресу: http://localhost:8180

PhpMyAdmin доступен по адресу: http://localhost:8081

## Работа с сайтом

Все сохраненные новости доступны на главной странице. Отображаются все новости всех пользователей.

Чтобы получить доступ к управлению новостями, необходимо пройти процедуру простой регистрации.

Для регистрации перейдите в верхнем меню по ссылке SignUp. Регистрация простейшая и не требует никаких подтверждений.

После авторизации будет доступен пункт меню администратора: `Редактировать новости`. При переходе в данный раздел
по умолчанию отображается список всех новостей **текущего** пользователя.

Над списком всех новостей доступна кнопка "Добавить новость".

Для каждой новости доступны действия:
* Редактировать
* Удалить