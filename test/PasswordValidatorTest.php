<?php

namespace Training\PHPUnit\PasswordValidator\Test;


use PHPUnit_Framework_MockObject_MockObject;
use Training\PHPUnit\PasswordValidator\PasswordStrengthCalculatorInterface;
use Training\PHPUnit\PasswordValidator\PasswordValidator;

class PasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PasswordValidator
     */
    private $passwordValidator;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $passwordStrengthCalculator;

    public function setUp()
    {
        $this->passwordStrengthCalculator = $this->getMockBuilder(PasswordStrengthCalculatorInterface::class)->getMock();
        $this->passwordValidator = new PasswordValidator($this->passwordStrengthCalculator);
    }

    
    public function testValidPassword()
    {

        $this->passwordStrengthCalculator
            ->expects($this->once())
            ->method("getPasswordStrength")
            ->with($this->equalTo('MyPassword1'))
            ->willReturn(3);

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
        $this->passwordStrengthCalculator
            ->method("getPasswordStrength")
            ->willReturn(3);

        $this->assertFalse($this->passwordValidator->isValid($invalidPassword));
    }

    
    public function testPasswordScoreTooLow()
    {
        $this->passwordStrengthCalculator
            ->expects($this->once())
            ->method("getPasswordStrength")
            ->with($this->equalTo('MyPassword1'))
            ->willReturn(2);

        $this->assertFalse($this->passwordValidator->isValid("MyPassword1"));
    }

}