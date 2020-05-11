<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    private $name, $price;

    public function __constructor($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
