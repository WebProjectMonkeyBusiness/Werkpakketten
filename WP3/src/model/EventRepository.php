<?php

namespace model;

interface EventRepository
{
    public function GetEventByID($id);
    public function createEvent($requestBody);
    public function updateEvent($id, $requestBody);
    public function deleteEvent($id);
    public function getAllEvents();
    public function getEventsFromPerson($id);
    public function getEventByDate($from, $until);
    public function getEventByPersonByDate($from, $until, $id);
}
