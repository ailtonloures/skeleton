<?php

namespace App\Services;

use App\Traits\Validation;

final class Validator
{

    use Validation;

    /**
     * @param array $rules
     * @return Validator
     */
    public static function make(array $target, array $rules, array $messages = null): Validator
    {
        foreach ($rules as $input => $rule) {
            if (self::emptyOrIsset($input, $target)) {
                foreach (explode("|", $rule) as $validation) {
                    $method = first(explode(":", $validation));
                    if ($method == 'type') {
                        $validation = explode(",", last(explode(":", $validation)));
                    } else {
                        $validation = last(explode(":", $validation));
                    }

                    $msg = null;

                    if (!empty($messages) && key_exists($input, $messages)) {
                        foreach ($messages[$input] as $inputMessage => $message) {
                            if ($inputMessage == $method) {
                                $msg = $message;
                            }
                        }
                    }

                    self::{$method}($input, $msg, $target[$input], $validation ?? null);
                }
            }
        }


        return new static();
    }

    /**
     * @return array|null
     */
    public static function fails() :?array
    {
        if(!empty($msg = self::messages())) {
            return [ 'validation' => $msg ];
        }

        return null;
    }

    /**
     * @return boolean
     */
    public static function valid() : bool
    {
        if(empty(self::messages())) {
            return true;
        }

        return false;
    }

}