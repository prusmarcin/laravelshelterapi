<?php

namespace Tests\Unit;

use App\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerTest extends AppBaseTestClass
{
    use RefreshDatabase;

    /**
     * Test worker model fields
     */
    public function testWorkerModelFields()
    {
        $worker = $this->createWorker1();

        $this->assertNotNull($worker);
        $this->assertEquals(37, $worker->age);
        $this->assertEquals("Andrzej Kurzewski", $worker->name);
    }

    /**
     * Test worker -> cats relation
     */
    public function testWorkerCatsRelations()
    {
        $this->createShelter2();

        $worker1 = Worker::where("name", "like", "%Anita%")->first();
        $worker2 = Worker::where("name", "Andrzej Kurzewski")->first();

        $this->assertCount(1, $worker1->cats);
        $this->assertCount(3, $worker2->cats);

        $cat = $worker2->cats()->where("name", "Burek")->first();

        $this->assertEquals("czerwony", $cat->color);
    }
}
