<?php

    namespace App\Core;

    class Session
    {
        public static function start()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }

        public static function get($key)
        {
            return $_SESSION[$key] ?? null;
        }

        public static function put($key, $value)
        {
            $_SESSION[$key] = $value;
        }

        public static function has($key): bool
        {
            return isset($_SESSION[$key]);
        }

        public static function forget(string $key): void
        {
            unset($_SESSION[$key]);
        }

        public static function flash(string $key, $value)
        {
            $_SESSION['flash'][$key] = $value;
        }

        public static function getFlash(string $key)
        {
            return $_SESSION['flash'][$key] ?? null;
        }

        public static function flashHas($key) : bool
        {
            return isset($_SESSION['flash'][$key]);
        }

        public static function clearFlash()
        {
            unset($_SESSION['flash']);
        }
    }