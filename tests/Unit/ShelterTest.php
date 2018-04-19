<?php

namespace Tests\Unit;

use App\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShelterTest extends AppBaseTestClass
{
    use RefreshDatabase;

    /**
     * Test generating unique key for shelter
     */
    public function testKeyGeneration()
    {
        $key = Shelter::generateUSKey();
        $other_shelter = Shelter::where("uskey", $key)->first();

        $this->assertEquals($other_shelter, null);
        $this->assertEquals(strlen($key), 5);
        $this->assertRegExp("/[0-9a-zA-z]{5}/", $key);
    }

    /**
     * Test shelter fields and model using
     */
    public function testShelterFields()
    {
        $key = $this->createShelter1()->uskey;
        $shelter = Shelter::where("uskey", $key)->first();

        $this->assertEquals("Warszawa", $shelter->city);
        $this->assertEquals("Schronisko Warszawa", $shelter->name);
        $this->assertEquals(2500, $shelter->size);
    }

    /**
     * Test relation shelter -> workers
     */
    public function testShelterWorkersRelation()
    {
        $key = $this->createShelter2()->uskey;
        $shelter = Shelter::where("uskey", $key)->first();

        $worker1 = $shelter->workers()->where("name", "Andrzej Kurzewski")->get();
        $worker2 = $shelter->workers()->where("name", "like", "%Anita%")->get();
        $worker3 = $shelter->workers()->where("name", "Paweł Kolas")->get();

        $this->assertNotNull($worker1);
        $this->assertNotNull($worker2);
        $this->assertEmpty($worker3);
        $this->assertCount(2, $shelter->workers);
    }

    /**
     * Test relation shelter -> cats
     */
    public function testShelterCatsRelation()
    {
        $key = $this->createShelter2()->uskey;
        $shelter = Shelter::where("uskey", $key)->first();

        $cat1 = $shelter->cats()->where("name", "Rock")->get();
        $cat2 = $shelter->cats()->where("name", "like", "%Kat%")->get();

        $this->assertNotNull($cat1);
        $this->assertNotNull($cat2);
        $this->assertCount(4, $shelter->cats);
    }
}
