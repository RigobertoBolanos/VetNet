<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Appointment
 * @package App\Models
 * @version May 13, 2020, 6:04 am UTC
 *
 * @property \App\Models\Pet $pet
 * @property \App\Models\Users $veterinary
 * @property \Illuminate\Database\Eloquent\Collection $services
 * @property integer $pet
 * @property integer $veterinary
 * @property integer $services
 */
class Appointment extends Model
{
    use SoftDeletes;

    public $table = 'appointments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'pet',
        'assigned_to',
        'services',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pet' => 'integer',
        'assigned_to' => 'integer',
        'services' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pet()
    {
        return $this->belongsTo(\App\Models\Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function assignedTo()
    {
        return $this->belongsTo(\App\Models\Users::class, 'assignedTo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function service()
    {
        return $this->hasOne(\App\Models\Service::class);
    }
}
