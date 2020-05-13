<?php

namespace App\Repositories;

use App\Models\MedicalRecord;
use App\Repositories\BaseRepository;

/**
 * Class MedicalRecordRepository
 * @package App\Repositories
 * @version May 13, 2020, 6:02 am UTC
*/

class MedicalRecordRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diagnosis',
        'treatments',
        'consultationreason'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicalRecord::class;
    }
}
