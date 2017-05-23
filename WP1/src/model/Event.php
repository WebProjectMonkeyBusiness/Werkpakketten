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

    /**
     * @return mixed
     */
    public function getBeginDatum()
    {
        return $this->beginDatum;
    }

    /**
     * @param mixed $beginDatum
     */
    public function setBeginDatum($beginDatum)
    {
        $this->beginDatum = $beginDatum;
    }

    /**
     * @return mixed
     */
    public function getEindDatum()
    {
        return $this->eindDatum;
    }

    /**
     * @param mixed $eindDatum
     */
    public function setEindDatum($eindDatum)
    {
        $this->eindDatum = $eindDatum;
    }

    /**
     * @return mixed
     */
    public function getPersonID()
    {
        return $this->person_ID;
    }

    /**
     * @param mixed $person_ID
     */
    public function setPersonID($person_ID)
    {
        $this->person_ID = $person_ID;
    }

    /**
     * @return mixed
     */
    public function getBezetting()
    {
        return $this->bezetting;
    }

    /**
     * @param mixed $bezetting
     */
    public function setBezetting($bezetting)
    {
        $this->bezetting = $bezetting;
    }

    /**
     * @return mixed
     */
    public function getKost()
    {
        return $this->kost;
    }

    /**
     * @param mixed $kost
     */
    public function setKost($kost)
    {
        $this->kost = $kost;
    }

    /**
     * @return mixed
     */
    public function getMaterialen()
    {
        return $this->materialen;
    }

    /**
     * @param mixed $materialen
     */
    public function setMaterialen($materialen)
    {
        $this->materialen = $materialen;
    }

    public function __toString()
    {
        return $this->ID . " " .
        $this->naam." " .
        $this->bezetting." " .
        $this->kost." " .
        $this->materialen." " .
        $this->person_ID;
    }


}
