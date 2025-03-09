# Инструкция по развертыванию приложения

## Установка

* Клонируем репозиторий командой `git clone https://github.com/sergey-kiryanov/worker.git`
* Переходим в директорию с проектом
* Устанавливаем зависимости `composer install`
* Копируем `.env.example` в `.env`
* Создаем ключ для приложения `php artisan key:generate`
* Запускаем миграции `php artisan migrate`
* Запускаем сидеры `php artisan db:seed`
* Запускаем сервер `php artisan serve`

## Настройка laravel passport

* Устанавливаем passport командой `php artisan install:api --passport`
* Генерируем ключи шифрования `php artisan passport:keys`
* Далее нам необходимо создать клиента для выпуска токенов персонального доступа, делаем это командой `php artisan passport:client --personal`
* После введения команды в консоли, нам предложат указать имя для клиента, выбираем любое.
* После создания клиента мы получим в терминал его ID и секрет, которые нам нужно заполнить в файле `.env` в секции `PASSPORT_PERSONAL_ACCESS_CLIENT_ID` и `PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET`

