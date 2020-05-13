<?php namespace Tests\Repositories;

use App\Models\Pet;
use App\Repositories\PetRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PetRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PetRepository
     */
    protected $petRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->petRepo = \App::make(PetRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pet()
    {
        $pet = factory(Pet::class)->make()->toArray();

        $createdPet = $this->petRepo->create($pet);

        $createdPet = $createdPet->toArray();
        $this->assertArrayHasKey('id', $createdPet);
        $this->assertNotNull($createdPet['id'], 'Created Pet must have id specified');
        $this->assertNotNull(Pet::find($createdPet['id']), 'Pet with given id must be in DB');
        $this->assertModelData($pet, $createdPet);
    }

    /**
     * @test read
     */
    public function test_read_pet()
    {
        $pet = factory(Pet::class)->create();

        $dbPet = $this->petRepo->find($pet->id);

        $dbPet = $dbPet->toArray();
        $this->assertModelData($pet->toArray(), $dbPet);
    }

    /**
     * @test update
     */
    public function test_update_pet()
    {
        $pet = factory(Pet::class)->create();
        $fakePet = factory(Pet::class)->make()->toArray();

        $updatedPet = $this->petRepo->update($fakePet, $pet->id);

        $this->assertModelData($fakePet, $updatedPet->toArray());
        $dbPet = $this->petRepo->find($pet->id);
        $this->assertModelData($fakePet, $dbPet->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pet()
    {
        $pet = factory(Pet::class)->create();

        $resp = $this->petRepo->delete($pet->id);

        $this->assertTrue($resp);
        $this->assertNull(Pet::find($pet->id), 'Pet should not exist in DB');
    }
}
