Сервис агрегатор для проведения фиктивных опросов

Необходим сервис, который может предоставить функционал управления фиктивными(с заранее предустановленным количеством голосов) опросами(далее просто - “опросы”).

Пользователь сервиса должен иметь возможность зайти на публичную часть приложения, зарегистрироваться и создать любое количество опросов, с заранее проставленным количеством ответов на тот или иной пункт, в формате:

Вопрос?
1. Ответ 1
2. Ответ 2
3. …
   …
   n. …

Требуемый функционал:

1. Аутентификация на сервисе.
   Страница регистрации
   Страница логина
   Разлогин
2. От пользователя нужен только email и пароль.
3. Аутентифицированный пользователь попадает в личный кабинет.
4. Личный кабинет:
   Содержит раздел со списком собственных опросов.
   Сортировка списка по “дате создания”, “заголовку”, “статусу”.
   CRUD для управления опросами.
   Каждый опрос содержит:
   текст вопроса(заголовок);
   любое количество ответов;
   количество голосов к каждому из ответов;
   статус “черновик” или “опубликован”.


Конечный пользователь, использующий данный сервис, должен получить доступ к API для получения данных рандомного опубликованного опроса из своего списка.
Данные должны содержать:
заголовок
пункты ответов с количеством голосов по каждому из них.

API будет тестироваться с использованием Postman.

Требования к реализации:

Нужно с помощью чистого PHP реализовать модель MVC
Фреймворки PHP использовать нельзя, библиотеки – можно.
Этому приложению не нужна сложная архитектура, решите поставленные задачи минимально необходимым количеством кода.
Верстка на bootstrap, к дизайну особых требований нет.

После выполнению задания нужно:
Предоставить ссылку на git репозиторий Вашей работы.
Предоставить минимально необходимую документацию в любом удобочитаемом виде с описанием работы API.
Развернуть на любом бесплатном хостинге, чтобы можно было посмотреть на результат.

