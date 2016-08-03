<?php

namespace Training\PHPUnit\PasswordValidator;


class PasswordValidator
{

    /**
    * Returns true if the password meets following rules:
    *
    * - min 8 characters
    * - contains 1 digit
    * - contains 1 lowercase letter
    * - contains 1 uppercase letter
    * - password strength of 3
    *
    * @param string $password
    * @return bool
    */
    public function isValid($password)
    {
        if (!is_string($password)) {
            return false;
        }

        if (strlen($password) < 8) {
            return false;
        }

        if (preg_match('/[0-9]/', $password) != 1) {
            return false;
        }

        if (preg_match('/[a-z]/', $password) != 1) {
            return false;
        }

        if (preg_match('/[A-Z]/', $password) != 1) {
            return false;
        }

        return true;
    }

}