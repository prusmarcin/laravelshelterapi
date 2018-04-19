<?php

namespace Tests\Feature;

use App\Cat;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\AppBaseTestClass;

class CatsAPITest extends AppBaseTestClass
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Test all cats API
     */
    public function testCats()
    {
        $this->createShelter1();
        $response = $this->json("GET", "/api/cats");

        $response->assertStatus(200)->assertJson([
            [
                "name" => "Kiciuś",
                "color" => "brązowy"
            ],
            [
                "name" => "Trebusz",
                "color" => "czarno-szary"
            ],
            [
                "name" => "Opon",
                "color" => "rudy"
            ],
        ]);
    }

    /**
     * Test message if cats not exist
     */
    public function testNotCats()
    {
        $response = $this->json("GET", "/api/cats");

        $response->assertStatus(200)->assertJson([
            "msg" => "Not found cats"
        ]);
    }

    /**
     * Test cat API
     */
    public function testCat()
    {
        $this->createShelter2();

        $cat = Cat::where("name", "Katian")->first();

        $response = $this->json("GET", "/api/cats/".$cat->id);

        $response->assertStatus(200)->assertJson([
            "name" => "Katian",
            "color" => "niebieski"
        ]);
    }

    /**
     * Test message if cat not exist
     */
    public function testNotCat()
    {
        $response = $this->json("GET", "/api/cats/-1");

        $response->assertStatus(200)->assertJson([
            "msg" => "Not found cat"
        ]);
    }
}
