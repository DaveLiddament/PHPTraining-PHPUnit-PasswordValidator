<?php

namespace Training\PHPUnit\PasswordValidator\Test;


use Training\PHPUnit\PasswordValidator\PasswordValidator;

class PasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PasswordValidator
     */
    private $passwordValidator;


    public function setUp()
    {
        $this->passwordValidator = new PasswordValidator();
    }

    public function testValidPassword()
    {
        $this->assertTrue($this->passwordValidator->isValid("MyPassword1"));
    }

    public function invalidPasswordsDataProvider()
    {
        return [
            ['MyPass1'],
            ['MyPassword'],
            ['mypassword1'],
            ['MYPASSWORD1'],
        ];
    }

    /**
     * @dataProvider invalidPasswordsDataProvider
     */
    public function testInvalidPassword($invalidPassword)
    {
        $this->assertFalse($this->passwordValidator->isValid($invalidPassword));
    }


}