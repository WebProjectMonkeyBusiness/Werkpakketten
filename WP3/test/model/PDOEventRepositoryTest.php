<?php

use \model\Event;
use \model\PDOEventRepository;

class PDORepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPDOStatement = $this->getMockBuilder('PDOStatement')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testFindEventById_idExists_EventObject()
    {
        $event = new Event(1, 'testevent');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['id' => $event->getId(), 'name' => $event->getName()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById($event->getId());

        $this->assertEquals($event, $actualEvent);
    }

    public function testFindEventById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(222);

        $this->assertNull($actualEvent);
    }

    public function testFindEventById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will($this->throwException(new Exception()));


        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->findEventById(1);

        $this->assertNull($actualEvent);
    }


}