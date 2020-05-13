<?php namespace Tests\Repositories;

use App\Models\MedicalRecord;
use App\Repositories\MedicalRecordRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MedicalRecordRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicalRecordRepository
     */
    protected $medicalRecordRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicalRecordRepo = \App::make(MedicalRecordRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->make()->toArray();

        $createdMedicalRecord = $this->medicalRecordRepo->create($medicalRecord);

        $createdMedicalRecord = $createdMedicalRecord->toArray();
        $this->assertArrayHasKey('id', $createdMedicalRecord);
        $this->assertNotNull($createdMedicalRecord['id'], 'Created MedicalRecord must have id specified');
        $this->assertNotNull(MedicalRecord::find($createdMedicalRecord['id']), 'MedicalRecord with given id must be in DB');
        $this->assertModelData($medicalRecord, $createdMedicalRecord);
    }

    /**
     * @test read
     */
    public function test_read_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();

        $dbMedicalRecord = $this->medicalRecordRepo->find($medicalRecord->id);

        $dbMedicalRecord = $dbMedicalRecord->toArray();
        $this->assertModelData($medicalRecord->toArray(), $dbMedicalRecord);
    }

    /**
     * @test update
     */
    public function test_update_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();
        $fakeMedicalRecord = factory(MedicalRecord::class)->make()->toArray();

        $updatedMedicalRecord = $this->medicalRecordRepo->update($fakeMedicalRecord, $medicalRecord->id);

        $this->assertModelData($fakeMedicalRecord, $updatedMedicalRecord->toArray());
        $dbMedicalRecord = $this->medicalRecordRepo->find($medicalRecord->id);
        $this->assertModelData($fakeMedicalRecord, $dbMedicalRecord->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medical_record()
    {
        $medicalRecord = factory(MedicalRecord::class)->create();

        $resp = $this->medicalRecordRepo->delete($medicalRecord->id);

        $this->assertTrue($resp);
        $this->assertNull(MedicalRecord::find($medicalRecord->id), 'MedicalRecord should not exist in DB');
    }
}
