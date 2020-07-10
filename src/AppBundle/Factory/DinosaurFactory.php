<?php


namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociaraptor(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociaraptor', true, $length);
    }

    public function growFromSpecification(string $spec): Dinosaur
    {

    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }
}