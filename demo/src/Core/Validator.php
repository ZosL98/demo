<?php

    namespace App\Core;

    use App\Models\Validation;
    
    class Validator
    {
        public static function string($val, $min = 1, $max = INF)
        {
            return strlen($val) >= $min && strlen($val) <= $max;
        }

        public static function email($val)
        {
            return filter_var($val, FILTER_VALIDATE_EMAIL);
        }

        public static function validate($array = [])
        {
            $errors = [];

            foreach ($array as $key => $values) {
                $input = isset($_POST[$key]) ? trim($_POST[$key]) : $_FILES[$key] ?? null;

                if (empty($input) && !in_array("required", $values)) continue;

                foreach($values as $v) {

                    if ($v === 'required') {
                        empty($input) ? $errors[$key] = ucfirst(implode(" ", explode("_", $key))) . " is required." : null;
                    }

                    if ($v === 'email') {
                        Validator::email($input) ? null : $errors[$key] = "Your $key is not well formed";
                    }

                    if (str_starts_with($v, 'min:')) {
                        $min = explode(':', $v)[1];

                        strlen($input) < $min ? $errors[$key] =  ucfirst(implode(" ", explode("_", $key))) . " must have at least $min characters" : null;
                    }

                    if (str_starts_with($v, 'max:')) {
                        $max = explode(':', $v)[1];

                        strlen($input) > $max ? $errors[$key] = ucfirst(implode(" ", explode("_", $key))) . " must have maximum $max characters" : null;
                    }

                    if (str_starts_with($v, 'matches:')) {
                        $input !== $_POST[(explode(":", $v)[1])] ? $errors[$key] = "Passwords do not match" : null;
                    }

                    if (str_starts_with($v, 'unique:')) {
                        $parsed = explode(':', $v)[1];
                        [$table, $column] = explode(',', $parsed);

                        $res = Validation::find($table, $column, $input);

                        $res ? $errors[$key] = "This $column is already taken" : null;
                    }

                    if ($v === "image") {
                        $allowedTypes = ["image/jpg", "image/jpeg", "image/png"];

                        if (isset($input) && $input['error'] === UPLOAD_ERR_OK) {

                            if (!in_array($input['type'], $allowedTypes)) {
                                $errors[$key] = "Sorry your file type must be jpeg or jpg or png";
                            }

                            if ($input['size'] > 5000000) {
                                $errors[$key] = "Sorry your file is too big";
                            }
                        }
                    }

                    if ($v === "password" && !empty($input)) {
                        $res = Validation::find("users", "id", Session::get('user_id'));

                        if (!$res || !password_verify($input, $res['password'])) {
                            $errors[$key] = "Wrong password.";
                        }
                    }
                    
                }
            }

            return $errors;
        }
    }
