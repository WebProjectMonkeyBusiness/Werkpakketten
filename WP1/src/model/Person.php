<?php

namespace model;

class Person
{
    private $ID;
    private $voornaam;
    private $naam;


    public function __construct($ID, $naam, $voornaam)
    {
        $this->ID = $ID;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
    }

}
