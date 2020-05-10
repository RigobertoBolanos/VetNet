<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    private $veterinary,
            $diagnosis,
            $treatments,
            $date,
            $consultationReason;

    public function __construct($veterinary,
                                $diagnosis,
                                $treatments,
                                $date,
                                $consultationReason)
    {
        $this->veterinary = $veterinary;
        $this->diagnosis = $diagnosis;
        $this->treatments = $treatments;
        $this->date = $date;
        $this->consultationReason = $consultationReason;
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
     * Get the value of diagnosis
     */ 
    public function getDiagnosis()
    {
                return $this->diagnosis;
    }

    /**
     * Set the value of diagnosis
     *
     * @return  self
     */ 
    public function setDiagnosis($diagnosis)
    {
                $this->diagnosis = $diagnosis;

                return $this;
    }

    /**
     * Get the value of treatments
     */ 
    public function getTreatments()
    {
                return $this->treatments;
    }

    /**
     * Set the value of treatments
     *
     * @return  self
     */ 
    public function setTreatments($treatments)
    {
                $this->treatments = $treatments;

                return $this;
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
     * Get the value of consultationReason
     */ 
    public function getConsultationReason()
    {
                return $this->consultationReason;
    }

    /**
     * Set the value of consultationReason
     *
     * @return  self
     */ 
    public function setConsultationReason($consultationReason)
    {
                $this->consultationReason = $consultationReason;

                return $this;
    }
}
