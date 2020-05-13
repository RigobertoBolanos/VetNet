<?php

namespace App\Repositories;

use App\Models\MedicalHistory;
use App\Repositories\BaseRepository;

/**
 * Class MedicalHistoryRepository
 * @package App\Repositories
 * @version May 13, 2020, 6:03 am UTC
*/

class MedicalHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return MedicalHistory::class;
    }
}
