<?php namespace Tests\Repositories;

use App\Models\MedicalHistory;
use App\Repositories\MedicalHistoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MedicalHistoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicalHistoryRepository
     */
    protected $medicalHistoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicalHistoryRepo = \App::make(MedicalHistoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->make()->toArray();

        $createdMedicalHistory = $this->medicalHistoryRepo->create($medicalHistory);

        $createdMedicalHistory = $createdMedicalHistory->toArray();
        $this->assertArrayHasKey('id', $createdMedicalHistory);
        $this->assertNotNull($createdMedicalHistory['id'], 'Created MedicalHistory must have id specified');
        $this->assertNotNull(MedicalHistory::find($createdMedicalHistory['id']), 'MedicalHistory with given id must be in DB');
        $this->assertModelData($medicalHistory, $createdMedicalHistory);
    }

    /**
     * @test read
     */
    public function test_read_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();

        $dbMedicalHistory = $this->medicalHistoryRepo->find($medicalHistory->id);

        $dbMedicalHistory = $dbMedicalHistory->toArray();
        $this->assertModelData($medicalHistory->toArray(), $dbMedicalHistory);
    }

    /**
     * @test update
     */
    public function test_update_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();
        $fakeMedicalHistory = factory(MedicalHistory::class)->make()->toArray();

        $updatedMedicalHistory = $this->medicalHistoryRepo->update($fakeMedicalHistory, $medicalHistory->id);

        $this->assertModelData($fakeMedicalHistory, $updatedMedicalHistory->toArray());
        $dbMedicalHistory = $this->medicalHistoryRepo->find($medicalHistory->id);
        $this->assertModelData($fakeMedicalHistory, $dbMedicalHistory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medical_history()
    {
        $medicalHistory = factory(MedicalHistory::class)->create();

        $resp = $this->medicalHistoryRepo->delete($medicalHistory->id);

        $this->assertTrue($resp);
        $this->assertNull(MedicalHistory::find($medicalHistory->id), 'MedicalHistory should not exist in DB');
    }
}
