<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedicalHistoryAPIRequest;
use App\Http\Requests\API\UpdateMedicalHistoryAPIRequest;
use App\Models\MedicalHistory;
use App\Repositories\MedicalHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicalHistoryController
 * @package App\Http\Controllers\API
 */

class MedicalHistoryAPIController extends AppBaseController
{
    /** @var  MedicalHistoryRepository */
    private $medicalHistoryRepository;

    public function __construct(MedicalHistoryRepository $medicalHistoryRepo)
    {
        $this->medicalHistoryRepository = $medicalHistoryRepo;
    }

    /**
     * Display a listing of the MedicalHistory.
     * GET|HEAD /medicalHistories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $medicalHistories = $this->medicalHistoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicalHistories->toArray(), 'Medical Histories retrieved successfully');
    }

    /**
     * Store a newly created MedicalHistory in storage.
     * POST /medicalHistories
     *
     * @param CreateMedicalHistoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalHistoryAPIRequest $request)
    {
        $input = $request->all();

        $medicalHistory = $this->medicalHistoryRepository->create($input);

        return $this->sendResponse($medicalHistory->toArray(), 'Medical History saved successfully');
    }

    /**
     * Display the specified MedicalHistory.
     * GET|HEAD /medicalHistories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->find($id);

        if (empty($medicalHistory)) {
            return $this->sendError('Medical History not found');
        }

        return $this->sendResponse($medicalHistory->toArray(), 'Medical History retrieved successfully');
    }

    /**
     * Update the specified MedicalHistory in storage.
     * PUT/PATCH /medicalHistories/{id}
     *
     * @param int $id
     * @param UpdateMedicalHistoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalHistoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->find($id);

        if (empty($medicalHistory)) {
            return $this->sendError('Medical History not found');
        }

        $medicalHistory = $this->medicalHistoryRepository->update($input, $id);

        return $this->sendResponse($medicalHistory->toArray(), 'MedicalHistory updated successfully');
    }

    /**
     * Remove the specified MedicalHistory from storage.
     * DELETE /medicalHistories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->find($id);

        if (empty($medicalHistory)) {
            return $this->sendError('Medical History not found');
        }

        $medicalHistory->delete();

        return $this->sendSuccess('Medical History deleted successfully');
    }
}
