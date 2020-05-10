<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    private $name, $age, $breed, $specie, $owner, $medicalHistory;

    public function __construct( $name, $age, $breed, $specie, $owner, $medicalHistory)
    {
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->specie = $specie;
        $this->owner = $owner;
        $this->medicalHistory = $medicalHistory;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of breed
     */ 
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set the value of breed
     *
     * @return  self
     */ 
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get the value of specie
     */ 
    public function getSpecie()
    {
        return $this->specie;
    }

    /**
     * Set the value of specie
     *
     * @return  self
     */ 
    public function setSpecie($specie)
    {
        $this->specie = $specie;

        return $this;
    }

    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of medicalHistory
     */ 
    public function getMedicalHistory()
    {
        return $this->medicalHistory;
    }

    /**
     * Set the value of medicalHistory
     *
     * @return  self
     */ 
    public function setMedicalHistory($medicalHistory)
    {
        $this->medicalHistory = $medicalHistory;

        return $this;
    }
}

