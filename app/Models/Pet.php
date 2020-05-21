<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

/**
 * Class Pet
 * @package App\Models
 * @version May 13, 2020, 6:01 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $appointments
 * @property \App\Models\User $owner
 * @property \App\Models\MedicalHistory $medicalHistory
 * @property string $name
 * @property string $breed
 * @property integer $age
 * @property integer $owner
 * @property integer $medicalhistory
 */
class Pet extends Model
{
    use SoftDeletes;

    public $table = 'pets';
    

    protected $dates = ['deleted_at'];

    protected $softCascade = ['medicalhistory'];

    public $fillable = [
        'name',
        'breed',
        'age',
        'owner',
        'medicalhistory'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'breed' => 'string',
        'age' => 'integer',
        'owner' => 'integer',
        'medicalhistory' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'breed' => 'required',
        'age' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function medicalHistory()
    {
        return $this->hasOne(\App\Models\MedicalHistory::class);
    }
}
