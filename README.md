# Microservice for working with guests

This project is a microservice developed using PHP, Laravel 11, and Docker for managing guests in a hotel system. The application exposes a RESTful API for performing CRUD operations on guest records. The service uses PostgreSQL as the database to store guest data and Nginx as the web server for routing HTTP requests.

## Tech Stack:
- PHP 8.3.2
- Laravel 11
- PostgreSQL
- Docker
- Nginx

## Overview:
This microservice allows for CRUD (Create, Read, Update, Delete) operations on guest data. The guest model includes:
- **id**: Unique identifier
- **first_name**: Guest's first name
- **last_name**: Guest's last name
- **phone_number**: Unique phone number (must be in international format)
- **email**: Unique email address
- **country**: The country is derived from the phone number (if not explicitly provided)

### Features:
- The phone number and email are required fields and must be unique.
- If the country is not provided, it is inferred from the phone number using the libphonenumber library.
- The system is built to validate inputs and provide appropriate error messages.

## API Documentation

The API allows for CRUD operations on guests, with endpoints to list, create, show, update, and delete guest records.

### 1. List Guests (`GET /api/v1/guests`)

Fetches a paginated list of guests.

#### Request:
- **Method**: GET
- **URL**: `/api/v1/guests`
- **Query Parameters**: Pagination parameters (`page`, `per_page`)

#### Example Request:
```
GET /api/v1/guests?page=1&per_page=5
```

#### Response:
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "phone_number": "+79295558899",
      "email": "john.doe@example.com",
      "country": "RU"
    }
  ],
  "links": {
    "previous_page": null,
    "next_page": "/api/v1/guests?page=2&per_page=5"
  },
  "meta": {
    "current_page": 1,
    "per_page": 5,
    "total": 50,
    "from": 1,
    "to": 5
  }
}
```

### 2. Create Guest (`POST /api/v1/guests`)

Creates a new guest.

#### Request:
- **Method**: POST
- **URL**: `/api/v1/guests`
- **Body** (JSON):
```json
{
  "first_name": "Jane",
  "last_name": "Doe",
  "phone_number": "+79295558888",
  "email": "jane.doe@example.com",
  "country": "RU"
}
```

#### Response:
```json
{
  "status": "success",
  "created_guest": {
    "id": 2,
    "first_name": "Jane",
    "last_name": "Doe",
    "phone_number": "+79295558888",
    "email": "jane.doe@example.com",
    "country": "RU"
  }
}
```

### 3. Show Guest (`GET /api/v1/guests/{id}`)

Fetches the details of a specific guest by ID.

#### Request:
- **Method**: GET
- **URL**: `/api/v1/guests/{id}`

#### Example Request:
```
GET /api/v1/guests/1
```

#### Response:
```json
{
  "status": "success",
  "selected_guest": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "phone_number": "+79295558899",
    "email": "john.doe@example.com",
    "country": "RU"
  }
}
```

### 4. Update Guest (`PUT /api/v1/guests/{id}`)

Updates the details of a specific guest by ID.

#### Request:
- **Method**: PUT
- **URL**: `/api/v1/guests/{id}`
- **Body** (JSON):
```json
{
  "first_name": "John",
  "last_name": "Doe",
  "phone_number": "+79295558899",
  "email": "new.email@example.com",
  "country": "RU"
}
```

#### Response:
```json
{
  "status": "success",
  "updated_guest": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "phone_number": "+79295558899",
    "email": "new.email@example.com",
    "country": "RU"
  }
}
```

### 5. Delete Guest (`DELETE /api/v1/guests/{id}`)

Deletes a specific guest by ID.

#### Request:
- **Method**: DELETE
- **URL**: `/api/v1/guests/{id}`

#### Example Request:
```
DELETE /api/v1/guests/1
```

#### Response:
```json
{
  "status": "success",
  "message": "guest removed"
}
```

## Running the Project

1. Clone the repository:
   ```bash
   git clone https://github.com/tstimur/hotel.git
   cd hotel
   ```

2. Build and run the Docker containers:
   ```bash
   make dcup
   ```

3. The application will be accessible at `http://localhost:8000`.
<br><br>
4. To stop the Docker containers:
   ```bash
   make dcdown
   ```

## Testing

To run the tests, use the following command:

```bash
php artisan test
```


### Test Task: PHP Backend Developer

The task is to create a microservice for managing guests using PHP or Go. The service should implement CRUD operations for guests, storing the data in a SQL database (PostgreSQL). The guest data includes the following attributes: `first_name`, `last_name`, `phone_number`, `email`, and `country`.

The country is automatically derived from the phone number if not provided explicitly. The system should also handle validation and error handling. The service should be containerized using Docker.

After completing the task, you should upload the code to a Git repository and provide a README file with project details, API documentation, and instructions for running the project.

## License

This project is licensed under the MIT License.


***

<h1>Микросервис для работы с гостями</h1>

<h2>Описание проекта</h2>

<p>Этот проект реализует микросервис для CRUD операций над гостями, который использует стек <code>php-postgresql-nginx-laravel11-docker</code>. Микросервис позволяет работать с данными гостей, где обязательными полями являются имя, фамилия и телефон. Поля телефон и email уникальны, а если страна не указана, то она определяется по номеру телефона.</p>

<h2>Стек технологий</h2>

<ul>
    <li>PHP 8.3</li>
    <li>Laravel 11</li>
    <li>PostgreSQL</li>
    <li>Nginx</li>
    <li>Docker</li>
</ul>

<h2>Описание тестового задания</h2>

<p>В рамках этого тестового задания был реализован микросервис для работы с данными гостей, который поддерживает CRUD операции. Веб-сервис предоставляет API для создания, изменения, получения и удаления данных гостей, а также автоматически извлекает страну по номеру телефона, если она не указана.</p>

<ul>
    <li><strong>Гость</strong> содержит следующие атрибуты:
        <ul>
            <li>id (идентификатор)</li>
            <li>first_name (имя)</li>
            <li>last_name (фамилия)</li>
            <li>email (email)</li>
            <li>phone_number (телефон)</li>
            <li>country (страна)</li>
        </ul>
    </li>
</ul>

<h3>Основные требования:</h3>
<ul>
    <li>Страна определяется по номеру телефона, если она не указана.</li>
    <li>Все операции с гостями (создание, обновление, удаление, получение) доступны через API.</li>
    <li>Все операции проверяют уникальность email и phone_number.</li>
</ul>

<h2>Структура проекта</h2>

<pre>
├── app
│   ├── Http
│   │   └── Controllers
│   │       └── Api
│   │           └── v1
│   │               └── GuestController.php
├── database
│   ├── migrations
│   ├── seeders
├── resources
│   └── views
├── routes
│   └── api.php
├── docker
├── .env
└── README.md
</pre>

<h2>Установка и запуск проекта</h2>

<ol>
    <li>Клонируйте репозиторий:
        <pre>git clone https://github.com/tstimur/hotel.git
cd hotel</pre>
    </li>
    <li>Убедитесь, что у вас установлен Docker. Если Docker не установлен, следуйте инструкции по установке на официальном сайте: <a href="https://www.docker.com/get-started">https://www.docker.com/get-started</a></li>
    <li>Создайте <code>.env</code> файл на основе <code>.env.example</code> и настройте параметры подключения к базе данных.</li>
    <li>Запустите Docker контейнеры:
        <pre>make dcup</pre>
    </li>
    <li>Примените миграции и запустите seeder, перейдя в контейнер <code>php-fpm</code>:
        <pre>php artisan migrate --seed</pre>
    </li>
    <li>Микросервис будет доступен по адресу: <a href="http://localhost">http://localhost</a>.</li>
</ol>

<h2>Установка и запуск проекта</h2>
<li>Остановить Docker контейнеры:
        <pre>make dcdown</pre>
    </li>


<h2>Документация API</h2>
<p>Также с опубликованной документацией из Postman можно ознакомиться по ссылке: <a href="https://documenter.getpostman.com/view/32314424/2sAY548KRz" target="_blank">Документация Postman</a></p>


<h3>1. Получение списка гостей 'index'</h3>

<p><strong>Метод:</strong> <code>GET /api/v1/guests</code></p>
<p><strong>Описание:</strong> Возвращает список гостей с пагинацией.</p>

<p><strong>Пример запроса:</strong></p>
<pre>curl -X GET http://localhost/api/v1/guests</pre>

<p><strong>Ответ:</strong></p>
<pre>
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "first_name": "Ivan",
      "last_name": "Egorov",
      "phone_number": "+79295558899",
      "email": "juice@mail.ru",
      "country": "RU"
    }
  ],
  "links": {
    "previous_page": null,
    "next_page": "http://localhost/api/v1/guests?page=2"
  },
  "meta": {
    "current_page": 1,
    "per_page": 5,
    "total": 10,
    "from": 1,
    "to": 5
  }
}
</pre>

<h3>2. Создание нового гостя 'store'</h3>

<p><strong>Метод:</strong> <code>POST /api/v1/guests</code></p>
<p><strong>Описание:</strong> Создает нового гостя. Если страна не указана, она будет определена по номеру телефона.</p>

<p><strong>Пример запроса:</strong></p>
<pre>curl -X POST http://localhost/api/v1/guests \
     -d "first_name=Sayan&last_name=Shtolts&phone_number=+79295558899&email=juice@mail.ru"
</pre>

<p><strong>Ответ:</strong></p>
<pre>
{
  "status": "success",
  "created_guest": {
    "id": 1,
    "first_name": "Sayan",
    "last_name": "Shtolts",
    "phone_number": "+79295558899",
    "email": "juice@mail.ru",
    "country": "RU"
  }
}
</pre>

<h3>3. Получение информации о конкретном госте 'show'</h3>

<p><strong>Метод:</strong> <code>GET /api/v1/guests/{id}</code></p>
<p><strong>Описание:</strong> Возвращает информацию о конкретном госте по ID.</p>

<p><strong>Пример запроса:</strong></p>
<pre>curl -X GET http://localhost/api/v1/guests/1</pre>

<p><strong>Ответ:</strong></p>
<pre>
{
  "status": "success",
  "selected_guest": {
    "id": 1,
    "first_name": "Sayan",
    "last_name": "Shtolts",
    "phone_number": "+79295558899",
    "email": "juice@mail.ru",
    "country": "RU"
  }
}
</pre>

<h3>4. Обновление информации о госте 'update'</h3>

<p><strong>Метод:</strong> <code>PUT /api/v1/guests/{id}</code></p>
<p><strong>Описание:</strong> Обновляет информацию о госте по ID.</p>

<p><strong>Пример запроса:</strong></p>
<pre>curl -X PUT http://localhost/api/v1/guests/1 \
     -d "first_name=NewName&last_name=NewLastName&phone_number=+79295558888&email=new@mail.ru"
</pre>

<p><strong>Ответ:</strong></p>
<pre>
{
  "status": "success",
  "updated_guest": {
    "id": 1,
    "first_name": "NewName",
    "last_name": "NewLastName",
    "phone_number": "+79295558888",
    "email": "new@mail.ru",
    "country": "RU"
  }
}
</pre>

<h3>5. Удаление гостя 'destroy'</h3>

<p><strong>Метод:</strong> <code>DELETE /api/v1/guests/{id}</code></p>
<p><strong>Описание:</strong> Удаляет гостя по ID.</p>

<p><strong>Пример запроса:</strong></p>
<pre>curl -X DELETE http://localhost/api/v1/guests/1</pre>

<p><strong>Ответ:</strong></p>
<pre>
{
  "status": "success",
  "message": "guest removed"
}
</pre>

<h2>Тестирование</h2>

<h3>Запуск тестов</h3>

<ol>
    <li>Убедитесь, что контейнеры запущены с помощью <code>make dcup</code>.</li>
    <li>Запустите Unit и Feature тесты, перейдя в контейнер <code>php-fpm</code>:
        <pre>php artisan test</pre>
    </li>
</ol>

<h2>Лицензия</h2>

<p>Этот проект является частью тестового задания. Используйте его согласно условиям лицензии MIT.</p>

---
***


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
