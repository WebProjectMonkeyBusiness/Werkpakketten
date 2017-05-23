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
        $requestBody = file_get_contents('php://input');

        switch ($method) {
            case 'PUT':
                if (isset($request[1])) {
                    $id = $request[1];
                    $this->eventRepository->updateEvent($id);
                    $event = json_decode($requestBody);
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($event);
                }
                break;

            case 'POST':
                if (isset($request[1])) {
                    $this->eventRepository->createEvent();

                  //  $event = json_decode($requestBody);
                    http_response_code(200);
                    header('Content-Type: application/json');
                   // echo json_encode($event);
                }
                break;

            case 'GET':
                    @$from = $_GET['from'];
                    @$until =  $_GET['until'];

                if ($from && $until && isset($request[3])) {
                    $id = $request[1];
                    $this->eventRepository->getEventByPersonByDate($from, $until, $id);

                    http_response_code(200);
                    header('Content-Type: application/json');
                }
                elseif ($from && $until) {
                    $this->eventRepository->getEventByDate($from, $until);

                    http_response_code(200);
                    header('Content-Type: application/json');
                }
                elseif (!empty($request[2])) {
                    $id = $request[2];
                    $event = $this->eventRepository->getEventsFromPerson($id);

                    http_response_code(200);
                    header('Content-Type: application/json');
                    //  echo json_encode($event);
                }
                elseif (!empty($request[1])) {
                    $id = $request[1];
                    $event = $this->eventRepository->getEventById($id);

                   http_response_code(200);
                    header('Content-Type: application/json');
                   //  echo json_encode($event);
                }
                elseif (isset($request[0])){

                    $event = $this->eventRepository->getAllEvents();

                   http_response_code(200);
                    header('Content-Type: application/json');
                  //  echo json_encode($event);
                }
                break;

            case 'DELETE':
                if (isset($request[1])) {
                    $id = $request[1];
                    $this->eventRepository->deleteEvent($id);

                    http_response_code(200);
                    header('Content-Type: application/json');
                  //  echo json_encode($event);
                }
                break;

            default:
                handle_error($request);
                break;
        }


    }
}

