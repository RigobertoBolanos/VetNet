<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 * @package App\Models
 * @version May 13, 2020, 6:01 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $appointments
 * @property number $price
 * @property string $name
 */
class Service extends Model
{
    use SoftDeletes;

    public $table = 'services';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'price',
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'double',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required',
        'name' => 'required',
        'description' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function appointment()
    {
        return $this->belongsTo(\App\Models\Appointment::class);
    }
}
