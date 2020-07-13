<?php


namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;

class DinosaurFactory
{
    /**
     * @var DinosaurLengthDeterminator
     */
    private $determinator;

    public function __construct(DinosaurLengthDeterminator $determinator)
    {
        $this->determinator = $determinator;
    }

    public function growVelociaraptor(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociaraptor', true, $length);
    }

    public function growFromSpecification(string $spec): Dinosaur
    {
        // defaults
        $codeName = 'InG-'.random_int(1, 999999);
        $length = $this->determinator->getLengthFromSpecification($spec);
        $isCarnivorous = false;

        if (stripos($spec, 'carnivorous') !== false){
            $isCarnivorous = true;
        }
        return $this->createDinosaur($codeName, $isCarnivorous, $length);
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }
}