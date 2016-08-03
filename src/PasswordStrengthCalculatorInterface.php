<?php

namespace Training\PHPUnit\PasswordValidator;

/**
 * Calculates the 'strength' of a password. 
 */
interface PasswordStrengthCalculatorInterface
{
    /**
     * Return strength of a password.
     * 
     * @param string $password
     * @return int 0(weak) to 5(strong)
     */
    public function getPasswordStrength($password);
}