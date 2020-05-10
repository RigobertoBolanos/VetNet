<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    private $pet,
            $medicalRecords;

    public function __construct($pet, $medicalRecords)
    {
        $this->pet = $pet;
        $this->medicalRecords = $medicalRecords;
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
     * Get the value of medicalRecords
     */ 
    public function getMedicalRecords()
    {
                return $this->medicalRecords;
    }

    /**
     * Set the value of medicalRecords
     *
     * @return  self
     */ 
    public function setMedicalRecords($medicalRecords)
    {
                $this->medicalRecords = $medicalRecords;

                return $this;
    }
}
