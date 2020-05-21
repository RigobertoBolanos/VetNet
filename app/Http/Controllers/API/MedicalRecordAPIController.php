<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedicalRecordAPIRequest;
use App\Http\Requests\API\UpdateMedicalRecordAPIRequest;
use App\Models\MedicalRecord;
use App\Repositories\MedicalRecordRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

/**
 * Class MedicalRecordController
 * @package App\Http\Controllers\API
 */

class MedicalRecordAPIController extends AppBaseController
{
    /** @var  MedicalRecordRepository */
    private $medicalRecordRepository;

    public function __construct(MedicalRecordRepository $medicalRecordRepo)
    {
        $this->medicalRecordRepository = $medicalRecordRepo;
    }

    /**
     * Display a listing of the MedicalRecord.
     * GET|HEAD /medicalRecords
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $medicalRecords = $this->medicalRecordRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicalRecords->toArray(), 'Medical Records retrieved successfully');
    }

    /**
     * Store a newly created MedicalRecord in storage.
     * POST /medicalRecords
     *
     * @param CreateMedicalRecordAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalRecordAPIRequest $request)
    {
        $input = $request->all();

        $medicalRecord = $this->medicalRecordRepository->create($input);

        return $this->sendResponse($medicalRecord->toArray(), 'Medical Record saved successfully');
    }

    /**
     * Display the specified MedicalRecord.
     * GET|HEAD /medicalRecords/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MedicalRecord $medicalRecord */
        $medicalRecord = $this->medicalRecordRepository->find($id);

        if (empty($medicalRecord)) {
            return $this->sendError('Medical Record not found');
        }

        return $this->sendResponse($medicalRecord->toArray(), 'Medical Record retrieved successfully');
    }

    /**
     * Display the specified MedicalRecord.
     * GET|HEAD /medicalHistory/medicalRecords/{medicalHistoryId}
     *
     * @param int $medicalHistoryId
     *
     * @return Response
     */
    public function findByMedicalHistory($medicalHistoryId)
    {
        /** @var MedicalRecord $medicalRecord */
        $medicalRecords = DB::table('medical_records')
                            ->select(DB::raw('*'))
                            ->where('medicalhistory', '=', $medicalHistoryId)
                            ->get();

        return $this->sendResponse($medicalRecords, 'Medical Record retrieved successfully');
    }

    /**
     * Update the specified MedicalRecord in storage.
     * PUT/PATCH /medicalRecords/{id}
     *
     * @param int $id
     * @param UpdateMedicalRecordAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalRecordAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicalRecord $medicalRecord */
        $medicalRecord = $this->medicalRecordRepository->find($id);

        if (empty($medicalRecord)) {
            return $this->sendError('Medical Record not found');
        }

        $medicalRecord = $this->medicalRecordRepository->update($input, $id);

        return $this->sendResponse($medicalRecord->toArray(), 'MedicalRecord updated successfully');
    }

    /**
     * Remove the specified MedicalRecord from storage.
     * DELETE /medicalRecords/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MedicalRecord $medicalRecord */
        $medicalRecord = $this->medicalRecordRepository->find($id);

        if (empty($medicalRecord)) {
            return $this->sendError('Medical Record not found');
        }

        $medicalRecord->delete();

        return $this->sendSuccess('Medical Record deleted successfully');
    }
}
