<?php

namespace model;

class Event
{
    private $ID;
    private $naam;
    private $beginDatum;
    private $eindDatum;
    private $person_ID;
    private $bezetting;
    private $kost;
    private $materialen;

    public function __construct($ID, $naam, $beginDatum, $eindDatum, $bezetting, $kost, $materialen, $person_ID)
    {
        $this->ID = $ID;
        $this->naam = $naam;
        $this->beginDatum = $beginDatum;
        $this->eindDatum = $eindDatum;
        $this->bezetting = $bezetting;
        $this->kost = $kost;
        $this->materialen = $materialen;
        $this->person_ID = $person_ID;
    }

    public function getId()
    {
        return $this->ID;
    }

    public function setName($naam)
    {
        $this->naam = $naam;
    }

    public function getName()
    {
        return $this->naam;
    }
}
