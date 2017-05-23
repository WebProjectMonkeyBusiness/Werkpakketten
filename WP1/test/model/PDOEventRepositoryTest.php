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

    public function testGetEventByPersonByDate_dateExists_EventObject()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventByPersonByDate($event->getBeginDatum(),$event->getEindDatum(),$event->getId());
        $testEvent = [['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }



    public function testGetEventByPersonByDate_exeptionThrownFromPDO_Null()
    {
        $date = new DateTime();
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will($this->throwException(new Exception()));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventByPersonByDate($date, $date, 1);

        $this->assertNull($actualEvent);
    }

    public function testGetEventByDate_dateExists_EventObject()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventByDate($event->getBeginDatum(),$event->getEindDatum());
        $testEvent = [['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }



    public function testGetEventsFromDate_exeptionThrownFromPDO_Null()
    {
        $date = new DateTime();
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will($this->throwException(new Exception()));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventByDate($date, $date);

        $this->assertNull($actualEvent);
    }




    public function getEventsFromPerson_personExists_EventObject()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventsFromPerson($event->getPersonID());
        $testEvent = [['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }

    public function testGetEventsFromPerson_idDoesNotExist_EmptyArray()
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
        $actualEvent = $pdoRepository->getEventsFromPerson(222);
        $testEvent = [];
        $this->AssertEquals($actualEvent,$testEvent);
    }

    public function testGetEventsFromPerson_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will($this->throwException(new Exception()));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventsFromPerson(1);

        $this->assertNull($actualEvent);
    }


    public function testGetEventById_idExists_EventObject()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->GetEventByID($event->getId());
        $testEvent = [['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }

    public function testGetEventById_idDoesNotExist_EmptyArray()
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
        $actualEvent = $pdoRepository->GetEventByID(222);
        $testEvent = [];
        $this->AssertEquals($actualEvent,$testEvent);
    }

    public function testGetEventById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will($this->throwException(new Exception()));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->GetEventByID(1);

        $this->assertNull($actualEvent);
    }

    public function createEvent_CreateEventWithValues()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->createEvent();
        $testEvent = [['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }

    public function createEvent_EmptyReturnsNull() {

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->createEvent();

        $this->assertNull($actualEvent);
    }

    public function DeleteEvent_DeleteReturnsSuccessString()
    {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');


        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->deleteEvent($event->getId());

        $this->assertEquals("event deleted successfully", $actualEvent);
    }

    public function updateEvent_returnsUpdatedEvent() {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => 'testedEvent', 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->updateEvent($event->getId());
        $testEvent = [['ID' => $event->getId(), 'naam' => 'testedEvent', 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);
    }

    public function getAll_PrintsAll() {
        $date = new DateTime();
        $event = new Event(1, 'testevent', $date, $date, "dingen", 12.5, "hout", 1);

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['ID' => $event->getId(), 'naam' => $event->getName(), 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]]));

        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->updateEvent($event->getId());
        $testEvent = [['ID' => $event->getId(), 'naam' => 'testedEvent', 'beginDatum' => $event->getBeginDatum(),'eindDatum' => $event->getEindDatum(),'bezetting' => $event->getBezetting(), "kost" => $event->getKost(),'materialen' => $event->getMaterialen(),'person_ID' => $event->getPersonID()]];

        $this->assertEquals($testEvent, $actualEvent);

    }



}