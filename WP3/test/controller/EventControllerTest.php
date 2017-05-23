<?php

use \model\Event;
use \controller\PersonController;

class EventControllerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockEventRepository = $this->getMockBuilder('model\EventRepository')
            ->getMock();
        $this->mockView = $this->getMockBuilder('view\View')
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockEventRepository = null;
        $this->mockView = null;
    }

    public function testHandleFindEventById_EventFound_stringWithIdName()
    {
        $event = new Event(1, 'testevent');
        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('findEventById')
            ->will($this->returnValue($event));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $event = $object['event'];
                printf("%d %s", $event->getId(), $event->getName());
            }));

        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventById($event->getId());
        $this->expectOutputString(sprintf("%d %s", $event->getId(), $event->getName()));
    }

    public function test_handleFindEventById_EventFound_returnStringEmpty()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('findEventById')
            ->will($this->returnValue(null));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '';
            }));

        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventById(1);
        $this->expectOutputString('');
    }
}
