<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Pet;

class PetApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pet()
    {
        $pet = factory(Pet::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pets', $pet
        );

        $this->assertApiResponse($pet);
    }

    /**
     * @test
     */
    public function test_read_pet()
    {
        $pet = factory(Pet::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/pets/'.$pet->id
        );

        $this->assertApiResponse($pet->toArray());
    }

    /**
     * @test
     */
    public function test_update_pet()
    {
        $pet = factory(Pet::class)->create();
        $editedPet = factory(Pet::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pets/'.$pet->id,
            $editedPet
        );

        $this->assertApiResponse($editedPet);
    }

    /**
     * @test
     */
    public function test_delete_pet()
    {
        $pet = factory(Pet::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pets/'.$pet->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pets/'.$pet->id
        );

        $this->response->assertStatus(404);
    }
}
