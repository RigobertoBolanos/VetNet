<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MedicalRecord;

class MedicalRecordApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medical_records', $medicalRecord
        );

        $this->assertApiResponse($medicalRecord);
    }

    /**
     * @test
     */
    public function test_read_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/medical_records/'.$medicalRecord->id
        );

        $this->assertApiResponse($medicalRecord->toArray());
    }

    /**
     * @test
     */
    public function test_update_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();
        $editedMedicalRecord = factory(MedicalRecord::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medical_records/'.$medicalRecord->id,
            $editedMedicalRecord
        );

        $this->assertApiResponse($editedMedicalRecord);
    }

    /**
     * @test
     */
    public function test_delete_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medical_records/'.$medicalRecord->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medical_records/'.$medicalRecord->id
        );

        $this->response->assertStatus(404);
    }
}
