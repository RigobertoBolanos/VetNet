<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    private $userName, 
            $password,
            $fullName,
            $address,
            $email,
            $phoneNumber,
            $professionalCard,
            $contratNumber,
            $academicDegrees,
            $pets;

    public function __construct($userName, 
                                $password,
                                $fullName,
                                $address,
                                $email,
                                $phoneNumber,
                                $professionalCard,
                                $contratNumber,
                                $academicDegrees,
                                $pets){

        $this->userName = $userName;
        $this->password = $password;
        $this->fullName = $fullName;
        $this->address = $address;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->professionalCard = $professionalCard;
        $this->contratNumber = $contratNumber;
        $this->academicDegrees = $academicDegrees;
        $this->pets = $pets;
    }

    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

            /**
             * Get the value of password
             */ 
            public function getPassword()
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setPassword($password)
            {
                        $this->password = $password;

                        return $this;
            }

            /**
             * Get the value of fullName
             */ 
            public function getFullName()
            {
                        return $this->fullName;
            }

            /**
             * Set the value of fullName
             *
             * @return  self
             */ 
            public function setFullName($fullName)
            {
                        $this->fullName = $fullName;

                        return $this;
            }

            /**
             * Get the value of address
             */ 
            public function getAddress()
            {
                        return $this->address;
            }

            /**
             * Set the value of address
             *
             * @return  self
             */ 
            public function setAddress($address)
            {
                        $this->address = $address;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail()
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail($email)
            {
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of phoneNumber
             */ 
            public function getPhoneNumber()
            {
                        return $this->phoneNumber;
            }

            /**
             * Set the value of phoneNumber
             *
             * @return  self
             */ 
            public function setPhoneNumber($phoneNumber)
            {
                        $this->phoneNumber = $phoneNumber;

                        return $this;
            }

            /**
             * Get the value of professionalCard
             */ 
            public function getProfessionalCard()
            {
                        return $this->professionalCard;
            }

            /**
             * Set the value of professionalCard
             *
             * @return  self
             */ 
            public function setProfessionalCard($professionalCard)
            {
                        $this->professionalCard = $professionalCard;

                        return $this;
            }

            /**
             * Get the value of contratNumber
             */ 
            public function getContratNumber()
            {
                        return $this->contratNumber;
            }

            /**
             * Set the value of contratNumber
             *
             * @return  self
             */ 
            public function setContratNumber($contratNumber)
            {
                        $this->contratNumber = $contratNumber;

                        return $this;
            }

            /**
             * Get the value of academicDegrees
             */ 
            public function getAcademicDegrees()
            {
                        return $this->academicDegrees;
            }

            /**
             * Set the value of academicDegrees
             *
             * @return  self
             */ 
            public function setAcademicDegrees($academicDegrees)
            {
                        $this->academicDegrees = $academicDegrees;

                        return $this;
            }

            /**
             * Get the value of pets
             */ 
            public function getPets()
            {
                        return $this->pets;
            }

            /**
             * Set the value of pets
             *
             * @return  self
             */ 
            public function setPets($pets)
            {
                        $this->pets = $pets;

                        return $this;
            }
}
