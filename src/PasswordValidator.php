<?php

namespace Training\PHPUnit\PasswordValidator;


class PasswordValidator
{

    /**
     * @var PasswordStrengthCalculatorInterface
     */
    private $passwordStrengthCalculator;

    /**
     * PasswordValidator constructor.
     * @param PasswordStrengthCalculatorInterface $passwordStrengthCalculator
     */
    public function __construct(PasswordStrengthCalculatorInterface $passwordStrengthCalculator)
    {
        $this->passwordStrengthCalculator = $passwordStrengthCalculator;
    }


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

        if ($this->getPasswordStrength($password) < 3) {
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

    
    private function getPasswordStrength($password)
    {
        $passwordStrength = $this->passwordStrengthCalculator->getPasswordStrength($password);
        if (!is_int($passwordStrength)) {
            throw new \Exception("Invalid password strength of [$passwordStrength] for password [$password]");
        }
        return $passwordStrength;
    }
}