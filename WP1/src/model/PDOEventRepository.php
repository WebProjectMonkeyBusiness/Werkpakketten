<?php

namespace model;

class PDOEventRepository implements EventRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function GetEventByID($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE ID=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

            return $event;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function createEvent()
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO events (naam, beginDatum, eindDatum, bezetting, kost, materialen, person_ID
                                                      values :naam, :beginDatum, :eindDatum, :bezetting, :kost, :materialen, :person_ID)');
            $params = $_POST;
            $statement->execute($params);

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

            return $event;
        } catch (\Exception $exception) {
            return null;
        }
    }


    public function updateEvent($id)
    {
        try {
            $statement = $this->connection->prepare('UPDATE events
                                                    SET naam = :naam, beginDatum = :beginDatum, eindDatum = :eindDatum, bezetting = :bezetting; kost = :kost, materialen = :materialen, person_ID = :person_ID
                                                    WHERE nummer = :nummer');
            $params = $_POST;
            $params['id'] = $_GET['id'];
            $statement->execute($params);

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

            return $event;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function deleteEvent($id)
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM events
                                                  WHERE ID = :ID');
            $params = $_GET;
            $statement->execute($params);
            $statement->execute();

            print_r("event deleted successfully");
            return "event deleted successfully";
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getAllEvents()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events');
            $statement->execute();

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);
            return($event);

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getEventsFromPerson($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE person_ID=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

            return $event;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getEventByDate($from, $until)
    {
        try {

            $statement = $this->connection->prepare('SELECT * FROM events WHERE beginDatum=? AND eindDatum=?');
            $statement->bindParam(1, $from);
            $statement->bindParam(2, $until);
            $statement->execute();

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getEventByPersonByDate($from, $until, $id){
        try {

            $statement = $this->connection->prepare('SELECT * FROM events WHERE beginDatum=? AND eindDatum=? AND person_id=?');
            $statement->bindParam(1, $from);
            $statement->bindParam(2, $until);
            $statement->bindParam(3, $id , \PDO::PARAM_INT);
            $statement->execute();

            $event = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($event);

        } catch (\Exception $exception) {
            return $exception;
        }
    }


}

