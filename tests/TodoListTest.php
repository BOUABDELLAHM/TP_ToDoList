<?php

namespace App\Tests;

use App\Entity\Item;
use App\Entity\TodoList;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;
use DateInterval;
use DateTimeZone;

class TodoListTest extends TestCase
{
    private $user;
    private $item;
    private $todolist;

    protected function setUp(): void
    {
        parent::setUp();

        $dateToday = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $myToday = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $dateNaissance = $dateToday->sub(new DateInterval('P30Y'))->format('Y-m-d');
        $createdItemAt = $myToday->add(new DateInterval('PT45M'));

        $this->user = new User(
            'BOUABDELLAH',
            'Marwane',
            'manbou92@hotmail.fr',
            'abdcde92230',
            "$dateNaissance"
        );

        $this->item = new Item(
            'Item1 Exemple',
            'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            $createdItemAt
        );

        $this->todolist = $this->getMockBuilder(TodoList::class)
            ->onlyMethods(['getSizeTodoList', 'getLastItem', 'sendEmailUser'])
            ->getMock();

        $this->todolist->setUser($this->user);
        $this->todolist->expects($this->any())->method('getLastItem')->willReturn($this->item);
    }

    public function testCanAddItemNominal()
    {
        $this->todolist->expects($this->any())->method('getSizeTodoList')->willReturn('1');

        $canAddItem = $this->todolist->canAddItem($this->item);

        $this->assertNotNull($canAddItem);
        $this->assertEquals('Item1 Exemple', $canAddItem->getName());
    }

    public function testSendEmailToUser()
    {
        $this->todolist->expects($this->once())->method('getSizeTodoList')->willReturn('8');

        $send = $this->todolist->numberItemAlert();

        $this->assertTrue($send);
    }

    public function testCanAddMaxItem()
    {
        $this->todolist->expects($this->any())->method('getSizeTodoList')->willReturn('10');
        $this->expectException('Exception');
        $this->expectExceptionMessage('Votre To Do List possède déjà des items');

        $canAddItem = $this->todolist->canAddItem($this->item);

        $this->assertTrue($canAddItem);
    }
}
