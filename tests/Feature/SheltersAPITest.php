<?php

namespace Tests\Feature;

use App\Shelter;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\AppBaseTestClass;

class SheltersAPITest extends AppBaseTestClass
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Test all cats API
     */
    public function testShelters()
    {
        $this->createShelter1();
        $this->createShelter2();
        $response = $this->json("GET", "/api/shelters");

        $response->assertStatus(200)->assertJson([
            [
                "name" => "Schronisko Gdańsk",
                "city" => "Gdańsk",
                "size" => 1150
            ],
            [
                "name" => "Schronisko Warszawa",
                "city" => "Warszawa",
                "size" => 2500
            ]
        ]);
    }

    /**
     * Test message if cats not exist
     */
    public function testNotShelters()
    {
        $response = $this->json("GET", "/api/shelters");

        $response->assertStatus(200)->assertJson([
            "msg" => "Not found shelters"
        ]);
    }

    /**
     * Test cat API
     */
    public function testShelter()
    {
        $this->createShelter2();

        $shelter = Shelter::where("city", "Gdańsk")->first();

        $response = $this->json("GET", "/api/shelters/".$shelter->uskey);

        $response->assertStatus(200)->assertJson([
            "name" => "Schronisko Gdańsk",
            "city" => "Gdańsk"
        ]);
    }

    /**
     * Test message if cat not exist
     */
    public function testNotShelter()
    {
        $response = $this->json("GET", "/api/shelters/-1");

        $response->assertStatus(200)->assertJson([
            "msg" => "Not found shelter"
        ]);
    }
}
