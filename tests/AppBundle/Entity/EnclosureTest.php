<?php


namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaursByDefault()
    {
        $enclosure = new Enclosure();
        $this->assertEmpty($enclosure->getDinosaurs());
    }

    public function testItAddsNoDinosaur()
    {
        $enclosure = new Enclosure();
        $enclosure->addDinosaur(new Dinosaur());
        $this->assertCount(1, $enclosure->getDinosaurs());
    }

}