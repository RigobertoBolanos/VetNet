<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePetAPIRequest;
use App\Http\Requests\API\UpdatePetAPIRequest;
use App\Models\Pet;
use App\Repositories\PetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PetController
 * @package App\Http\Controllers\API
 */

class PetAPIController extends AppBaseController
{
    /** @var  PetRepository */
    private $petRepository;

    public function __construct(PetRepository $petRepo)
    {
        $this->petRepository = $petRepo;
    }

    /**
     * Display a listing of the Pet.
     * GET|HEAD /pets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pets = $this->petRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pets->toArray(), 'Pets retrieved successfully');
    }

    /**
     * Store a newly created Pet in storage.
     * POST /pets
     *
     * @param CreatePetAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePetAPIRequest $request)
    {
        $input = $request->all();

        $pet = $this->petRepository->create($input);

        return $this->sendResponse($pet->toArray(), 'Pet saved successfully');
    }

    /**
     * Display the specified Pet.
     * GET|HEAD /pets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pet $pet */
        $pet = $this->petRepository->find($id);

        if (empty($pet)) {
            return $this->sendError('Pet not found');
        }

        return $this->sendResponse($pet->toArray(), 'Pet retrieved successfully');
    }

    /**
     * Update the specified Pet in storage.
     * PUT/PATCH /pets/{id}
     *
     * @param int $id
     * @param UpdatePetAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pet $pet */
        $pet = $this->petRepository->find($id);

        if (empty($pet)) {
            return $this->sendError('Pet not found');
        }

        $pet = $this->petRepository->update($input, $id);

        return $this->sendResponse($pet->toArray(), 'Pet updated successfully');
    }

    /**
     * Remove the specified Pet from storage.
     * DELETE /pets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pet $pet */
        $pet = $this->petRepository->find($id);

        if (empty($pet)) {
            return $this->sendError('Pet not found');
        }

        $pet->delete();

        return $this->sendSuccess('Pet deleted successfully');
    }
}
