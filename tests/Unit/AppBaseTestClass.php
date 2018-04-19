<?php

namespace Tests\Unit;


use App\Cat;
use App\Shelter;
use App\Worker;
use Tests\TestCase;

class AppBaseTestClass extends TestCase
{
    protected function createShelter1()
    {
        $shelter = Shelter::create([
            "uskey" => Shelter::generateUSKey(),
            "name" => "Schronisko Warszawa",
            "city" => "Warszawa",
            "size" => 2500
        ]);

        $worker = $this->createWorker3();
        $cats = $this->createCats1();

        $worker->cats()->saveMany($cats);
        $shelter->workers()->save($worker);
        $shelter->cats()->saveMany($cats);

        return $shelter;
    }

    protected function createShelter2()
    {
        $shelter = Shelter::create([
            "uskey" => Shelter::generateUSKey(),
            "name" => "Schronisko Gdańsk",
            "city" => "Gdańsk",
            "size" => 1150
        ]);

        $worker1 = $this->createWorker1();
        $cats1 = $this->createCats2();
        $worker1->cats()->saveMany($cats1);
        $shelter->workers()->save($worker1);

        $worker2 = $this->createWorker2();
        $cats2 = $this->createCat();
        $worker2->cats()->save($cats2);
        $shelter->workers()->save($worker2);

        $shelter->cats()->saveMany($cats1);
        $shelter->cats()->save($cats2);

        return $shelter;
    }

    protected function createWorker1()
    {
        $worker = Worker::create([
            "name" => "Andrzej Kurzewski",
            "age" => 37
        ]);

        return $worker;
    }

    protected function createWorker2()
    {
        $worker = Worker::create([
            "name" => "Anita Wiśnia",
            "age" => 31
        ]);

        return $worker;
    }

    protected function createWorker3()
    {
        $worker = Worker::create([
            "name" => "Paweł Kolas",
            "age" => 24
        ]);

        return $worker;
    }

    protected function createCats1()
    {
        $cats = [
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
        ];

        $ret = [];

        foreach($cats as $cat) {
            array_push($ret, Cat::create($cat));
        }

        return $ret;
    }

    protected function createCats2()
    {
        $cats = [
            [
                "name" => "Burek",
                "color" => "czerwony"
            ],
            [
                "name" => "Pola",
                "color" => "szary"
            ],
            [
                "name" => "Rock",
                "color" => "brązowy"
            ],
        ];

        $ret = [];

        foreach($cats as $cat) {
            array_push($ret, Cat::create($cat));
        }

        return $ret;
    }

    protected function createCat()
    {
        $cat = Cat::create([
            "name" => "Katian",
            "color" => "niebieski"
        ]);

        return $cat;
    }
}