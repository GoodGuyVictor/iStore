<?php
$configuration = [];

// Настройки окружения
$configuration["ENVIRONMENT"] = "PROD";

// настройки директорий
$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";

// Настройки БД
$configuration["DB"]["DB_HOST"] = "192.168.56.101"; // сервер БД
$configuration["DB"]["DB_USER"] = "root"; // логин
$configuration["DB"]["DB_PASS"] = "geekbrains"; // пароль
$configuration["DB"]["DB_NAME"] = "istore"; // имя БД
$configuration["DB"]["DB_CHARSET"] = "UTF8"; // имя БД

// Настройки роутинга
$configuration["ROUTER"] = [
    "customController/<action>" => "controllers/CustomController/<action>",
    "hello/<action>" => "controllers/HelloController/<action>",
    "order/<action>" => "controllers/OrderController/<action>",
    "cart/<action>" => "controllers/CartController/<action>",
    "checkout/<action>" => "controllers/CheckoutController/<action>",
    "signup/<action>" => "controllers/SignupController/<action>",
    "user/<action>" => "controllers/UserController/<action>",
    "controllers/<action>" => "controllers/ControllersController/<action>",
    "<controller>/<action>" => "controllers/<controller>/<action>"
];


