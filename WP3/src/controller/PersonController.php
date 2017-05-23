<?php

namespace controller;

use model\EventRepository;
use view\View;

class PersonController
{

    private $eventRepository;
    private $view;

    public function __construct(EventRepository $eventRepository, View $view)
    {
        $this->eventRepository = $eventRepository;
        $this->view = $view;
    }

    public function handleRequest($id = null)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
        $requestBody = json_decode(file_get_contents('php://input'), true);

        //&& strpos($request[0], 'events')
        switch ($method) {
            case 'PUT':
                if (!empty($request[1])) {
                    $id = $request[1];
                    $this->eventRepository->updateEvent($id, $requestBody);
                    http_response_code(200);
                }
                break;

            case 'POST':
                if (!empty($request[0])) {
                    $this->eventRepository->createEvent($requestBody);
                    http_response_code(200);
                }
                break;

            case 'GET':
                @$from = $_GET['from'];
                @$until = $_GET['until'];

                if ($from && $until && isset($request[3])) {
                    $id = $request[1];
                    $this->eventRepository->getEventByPersonByDate($from, $until, $id);

                    http_response_code(200);
                    header('Content-Type: application/json');
                } elseif ($from && $until) {
                    $this->eventRepository->getEventByDate($from, $until);

                    http_response_code(200);
                    header('Content-Type: application/json');
                } elseif (!empty($request[2])) {
                    $id = $request[2];
                    $this->eventRepository->getEventsFromPerson($id);

                    http_response_code(200);
                    header('Content-Type: application/json');

                } elseif (!empty($request[1])) {
                    $id = $request[1];
                    $event = $this->eventRepository->getEventById($id);

                    http_response_code(200);

                    return json_encode($event);
                } elseif (isset($request[0])) {

                    $this->eventRepository->getAllEvents();

                    http_response_code(200);

                }
                break;

            case 'DELETE':
                if (isset($request[1])) {
                    $id = $request[1];
                    $this->eventRepository->deleteEvent($id);

                    http_response_code(200);
                }
                break;

            case 'OPTIONS':
                http_response_code(204);

            default:
                return 'something went wrong, please try again later';
                break;
        }


    }
}

