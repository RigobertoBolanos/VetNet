<?php

namespace App\Repositories;

use App\Models\Pet;
use App\Repositories\BaseRepository;

/**
 * Class PetRepository
 * @package App\Repositories
 * @version May 13, 2020, 6:01 am UTC
*/

class PetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'breed',
        'age'
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
        return Pet::class;
    }
}
