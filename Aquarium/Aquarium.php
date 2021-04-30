<?php

class Aquarium
{
    private $animals = [];
    private $isLightOn = false;
    private $heaterMode = 1;

    public function putFish($name, $isHungry)
    {
        $this->sendMail();
        $this->sendSms();
        array_push($this->animals, FishFactory::create($name, $isHungry));
    }

    public function putTurtle($name, $isHungry)
    {
        $this->sendMail();
        $this->sendSms();
        array_push($this->animals, TurtleFactory::create($name, $isHungry));
    }

    public function putPlant($name) {
        $this->sendMail();
        $this->sendSms();
        array_push($this->animals, PlantFactory::create($name));
    }

    public function TurnLight()
    {
        if ($this->isLightOn) {
            $this->isLightOn = false;
        } else {
            $this->isLightOn = true;
            foreach ($this->animals as $animal) {
                if ($animal instanceof Animal)
                    $animal->swim();
            }
        }
    }

    public function show()
    {
        foreach ($this->animals as $animal) {
            echo $animal->getName() . "\n";
        }
    }

    public function feed($foodType)
    {
        foreach ($this->animals as $animal) {
            if ($animal instanceof Animal && $animal->isHungry()) {
                $animal->eat($foodType);
            }
        }
    }

    public function changeHeaterMode($heaterMode)
    {
        $this->heaterMode = $heaterMode;
        echo "Heater mode changed to " . $this->heaterMode;
    }

    private function sendMail()
    {
        //sends email
    }

    private function sendSms()
    {
        //sends sms
    }
}

interface PlantInterface
{
    public function breathe();
}

interface AnimalInterface
{
    public function swim();
    public function eat($foodType);
}

abstract class Animal
{
    private $name;
    private $isHungry = false;

    public function __construct($name, $isHungry)
    {
        $this->name = $name;
        $this->isHungry = $isHungry;
    }

    public function getName()
    {
        return $this->name;
    }

    public function breathe()
    {
        echo $this->getName() . " breathing\n";
    }

    public function isHungry()
    {
        return $this->isHungry;
    }
}

class Fish extends Animal implements AnimalInterface
{
    public function swim()
    {
        echo $this->getName() . " - Fish style swim\n";
    }

    public function eat($foodType)
    {
        if ($foodType == "FishFood")
            echo $this->getName() . " - eating\n";
    }

}
class Turtle extends Animal implements AnimalInterface
{
    public function swim()
    {
        echo $this->getName() . " - Turtle style swim\n";
    }

    public function eat($foodType)
    {
        if ($foodType == "TurtleFood")
            echo $this->getName() . " - eating\n";
    }
}

class Plant implements PlantInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function breathe()
    {
        echo $this->name . " breathing\n";
    }
}

interface AnimalFactory
{
    public function create($name, $isHungry);
}

class fishFactory implements AnimalFactory
{
    public function create($name, $isHungry)
    {
        return new Fish($name, $isHungry);
    }
}
class turtleFactory implements AnimalFactory
{
    public function create($name, $isHungry)
    {
        return new Turtle($name, $isHungry);
    }
}
class PlantFactory
{
    public function create($name)
    {
        return new Plant($name);
    }
}


$aquarium = new Aquarium();
$aquarium->putFish("Fish1", 1);
$aquarium->putTurtle("Turtle1", 0);
$aquarium->putTurtle("Turtle2", 1);
$aquarium->putPlant('Plant1');
$aquarium->show();
$aquarium->TurnLight();
$aquarium->feed("TurtleFood");
