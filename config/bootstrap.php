<?php

require __DIR__ . '/../vendor/autoload.php';

if (!isset($_SERVER['SERVER_NAME']) || $_SERVER['SERVER_NAME'] === "localhost")
    Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

require __DIR__ . '/routes.php';