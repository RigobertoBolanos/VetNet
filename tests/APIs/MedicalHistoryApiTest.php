<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MedicalHistory;

class MedicalHistoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medical_histories', $medicalHistory
        );

        $this->assertApiResponse($medicalHistory);
    }

    /**
     * @test
     */
    public function test_read_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/medical_histories/'.$medicalHistory->id
        );

        $this->assertApiResponse($medicalHistory->toArray());
    }

    /**
     * @test
     */
    public function test_update_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();
        $editedMedicalHistory = factory(MedicalHistory::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medical_histories/'.$medicalHistory->id,
            $editedMedicalHistory
        );

        $this->assertApiResponse($editedMedicalHistory);
    }

    /**
     * @test
     */
    public function test_delete_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medical_histories/'.$medicalHistory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medical_histories/'.$medicalHistory->id
        );

        $this->response->assertStatus(404);
    }
}
