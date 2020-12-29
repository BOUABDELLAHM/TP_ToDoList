<?php

namespace App\Test;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $dateToday = new DateTime('now');
        $dateNaissance = $dateToday->sub(new \DateInterval('P30Y'))->format('Y-m-d');

        $this->user = new User(
            'BOUABDELLAH',
            'Marwane',
            'manbou92@hotmail.fr',
            'abcde92230',
            "$dateNaissance"
        );
    }

    public function testIsValidNominal()
    {
        $this->assertTrue($this->user->isValid());
    }

    public function testIsNotPasswordSizeValid()
    {
        $this->user->setPassword('123');
        $this->assertFalse($this->user->isValid());
    }

    public function testIsNotPasswordEmptyValid()
    {
        $this->user->setPassword('');
        $this->assertFalse($this->user->isValid());
    }

    public function testIsNotEmailFormatValid()
    {
        $this->user->setEmail('azerty');
        $this->assertFalse($this->user->isValid());
    }

    public function testIsNotFirstnameEmptyValid()
    {
        $this->user->setFirstname('');
        $this->assertFalse($this->user->isValid());
    }

    public function testIsNotLastnameValid()
    {
        $this->user->setLastname('');
        $this->assertFalse($this->user->isValid());
    }
}
