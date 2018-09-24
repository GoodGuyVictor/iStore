<?php
$configuration = [];

// Environment settings
$configuration["ENVIRONMENT"] = "PROD";

// Directories settings
$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";

// Database settings
$configuration["DB"]["DB_HOST"] = "localhost"; // server
$configuration["DB"]["DB_USER"] = "root"; // login
$configuration["DB"]["DB_PASS"] = ""; // password
$configuration["DB"]["DB_NAME"] = "estore"; // DB name
$configuration["DB"]["DB_CHARSET"] = "UTF8";

// Routing settings
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


