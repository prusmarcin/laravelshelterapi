<?php

namespace Tests\Unit;

use App\Cat;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatTest extends AppBaseTestClass
{
    use RefreshDatabase;

    /**
     * Test cat field
     */
    public function testCatModelFields()
    {
        $this->createCats2();

        $cat = Cat::where("name", "Pola")->first();

        $this->assertNotNull($cat);
        $this->assertEquals("Pola", $cat->name);
        $this->assertEquals("szary", $cat->color);
    }

    /**
     * Test cat -> guardian relation
     */
    public function testCatGuardianRelation()
    {
        $this->createShelter1();
        $cat1 = Cat::where("name", "Kiciuś")->first();
        $cat2 = Cat::where("name", "Opon")->first();

        $this->assertNotNull($cat1);
        $this->assertNotNull($cat1->guardian);
        $this->assertEquals("Paweł Kolas", $cat1->guardian->name);

        $this->assertNotNull($cat2);
        $this->assertNotNull($cat2->guardian);
        $this->assertEquals("Paweł Kolas", $cat1->guardian->name);
    }

    /**
     * Test cat -> shelter relation
     */
    public function testCatShelterRelation()
    {
        $this->createShelter2();
        $cat1 = Cat::where("name", "Burek")->first();
        $cat2 = Cat::where("name", "Katian")->first();

        $this->assertNotNull($cat1);
        $this->assertNotNull($cat1->shelter);
        $this->assertEquals("Schronisko Gdańsk", $cat1->shelter->name);

        $this->assertNotNull($cat2);
        $this->assertNotNull($cat2->shelter);
        $this->assertEquals("Gdańsk", $cat1->shelter->city);
    }
}
