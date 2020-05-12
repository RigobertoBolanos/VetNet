<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    private $pet, $veterinary, $service, $date;

    public function __constructor($pet, $veterinary, $service, $date)
    {
        $this->pet = $pet ;
        $this->veterinary = $veterinary ;
        $this->service = $service ;
        $this->date = $date ;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of pet
     */ 
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Set the value of pet
     *
     * @return  self
     */ 
    public function setPet($pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get the value of veterinary
     */ 
    public function getVeterinary()
    {
        return $this->veterinary;
    }

    /**
     * Set the value of veterinary
     *
     * @return  self
     */ 
    public function setVeterinary($veterinary)
    {
        $this->veterinary = $veterinary;

        return $this;
    }

    /**
     * Get the value of service
     */ 
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @return  self
     */ 
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }
}
