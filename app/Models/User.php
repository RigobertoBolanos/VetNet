<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version May 13, 2020, 5:59 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $pets
 * @property \Illuminate\Database\Eloquent\Collection $medicalRecords
 * @property \Illuminate\Database\Eloquent\Collection $appointments
 * @property string $email
 * @property string $password
 * @property string $fullname
 * @property string $address
 * @property string $phonenumber
 * @property string $professionalcard
 * @property string $academicdegrees
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'email',
        'password',
        'fullname',
        'address',
        'phonenumber',
        'professionalcard',
        'academicdegrees'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'fullname' => 'string',
        'address' => 'string',
        'phonenumber' => 'string',
        'professionalcard' => 'string',
        'academicdegrees' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'email|required',
        'password' => 'required|min:8',
        'fullname' => 'required',
        'address' => 'required',
        'phonenumber' => 'required',
        'professionalcard' => 'required',
        'academicdegrees' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pets()
    {
        return $this->hasMany(\App\Models\Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicalRecords()
    {
        return $this->hasMany(\App\Models\MedicalRecord::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class);
    }
}
