<?php

    namespace App\Core;

    class Container
    {
        protected array $array = [];

        public function bind($key, $value)
        {
            $this->array[$key] = $value;

            return $this;
        }

        public function getArray()
        {
            return $this->array;
        }
    }