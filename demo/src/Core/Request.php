<?php

    namespace App\Core;

    class Request
    {
        public static function uri(): string
        {
            return strtok($_SERVER['REQUEST_URI'], '?');
        }

        public static function method(): string
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        public static function input(string $key)
        {
            return $_GET[$key] ?? $_POST[$key] ?? null;
        }

        public static function all(): array
        {
            return array_merge($_GET, $_POST);
        }

        public static function has(string $key): bool
        {
            return isset($_POST[$key]) || isset($_GET[$key]);
        }
    }