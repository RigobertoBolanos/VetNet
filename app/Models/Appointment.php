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
 * @property \App\Models\Service $service
 * @property integer $pet
 * @property integer $veterinary
 * @property integer $service
 */
class Appointment extends Model
{
    use SoftDeletes;

    public $table = 'appointments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'pet',
        'assigned_to',
        'service',
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
        'service' => 'integer'
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
