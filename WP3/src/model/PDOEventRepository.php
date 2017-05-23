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


           echo json_encode($event);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function createEvent($requestBody)
    {
        try {
            print_r('hi from create event');

            $statement = $this->connection->prepare('INSERT INTO events (naam, beginDatum, eindDatum, bezetting, 
                                                              kost, materialen, person_ID)
                                                      values (:naam, :beginDatum, :eindDatum, :bezetting, :kost, :materialen, :person_ID)');
            $statement->bindParam(':naam', $requestBody['naam'], \PDO::PARAM_STR);
            $statement->bindParam(':beginDatum', $requestBody['beginDatum']);
            $statement->bindParam(':eindDatum', $requestBody['eindDatum']);
            $statement->bindParam(':bezetting', $requestBody['bezetting'], \PDO::PARAM_STR);
            $statement->bindParam(':kost', $requestBody['kost']);
            $statement->bindParam(':materialen', $requestBody['materialen'], \PDO::PARAM_STR);
            $statement->bindParam(':person_ID', $requestBody['person_ID'],\PDO::PARAM_INT);
            $statement->execute();

            //$event = $statement->fetchAll(\PDO::FETCH_ASSOC);

            print_r( $statement->rowCount());
            // json_encode($event);
        } catch (\Exception $exception) {
            var_dump($exception);
            return $exception;
        }
    }


    public function updateEvent($id, $requestBody)
    {
        try {
            $statement = $this->connection->prepare('UPDATE events
                                                    SET naam = :naam, beginDatum = :beginDatum, eindDatum = :eindDatum, 
                                                    bezetting = :bezetting, kost = :kost, materialen = :materialen, person_ID = :person_ID
                                                    WHERE ID = :ID');
            $statement->bindParam(':naam', $requestBody['naam'], \PDO::PARAM_STR);
            $statement->bindParam(':beginDatum', $requestBody['beginDatum']);
            $statement->bindParam(':eindDatum', $requestBody['eindDatum']);
            $statement->bindParam(':bezetting', $requestBody['bezetting'], \PDO::PARAM_STR);
            $statement->bindParam(':kost', $requestBody['kost']);
            $statement->bindParam(':materialen', $requestBody['materialen'], \PDO::PARAM_STR);
            $statement->bindParam(':person_ID', $requestBody['person_ID'],\PDO::PARAM_INT);
            $statement->bindParam(':ID', $id,\PDO::PARAM_INT);
            $statement->execute();

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
            echo json_encode($event);

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
            return $exception;
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

