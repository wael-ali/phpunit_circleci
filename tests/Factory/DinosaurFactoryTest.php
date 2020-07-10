<?php


namespace Tests\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;

class DinosaurFactoryTest extends TestCase
{
    private $factory;

    public function setUp()
    {
        $this->factory = new DinosaurFactory();
    }
    public function testItGrowsAVelociaraptor()
    {
        $dinasour = $this->factory->growVelociaraptor(5);
        $this->assertInstanceOf(Dinosaur::class, $dinasour);
        $this->assertIsString($dinasour->getGenus());
        $this->assertSame('Velociaraptor',$dinasour->getGenus());
        $this->assertSame(5,$dinasour->getLength());

    }
    public function testItGrowsABabzVelociaraptor()
    {
        if (!class_exists('Nanny')){
            $this->markTestSkipped('There is no body to watch the baby after');
        }
        $dinasour = $this->factory->growVelociaraptor(1);
        $this->assertSame(1,$dinasour->getLength());

    }
    public function testItGrowsATriceraptos()
    {
        $this->markTestIncomplete('Waitin for confirms from Genlabs');
    }

    /**
     * @dataProvider getSpecificationTests
     */
    public function testItGrowsADinosaurFromSpecification(string $spec, bool $expectdIsLarge, bool $expectedIsCarnivorous)
    {
        $dinasour = $this->factory->growFromSpecification($spec);
        if ($expectdIsLarge){
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE,$dinasour->getLength());
        }else{
            $this->assertLessThan(Dinosaur::LARGE,$dinasour->getLength());
        }

        $this->assertSame($expectedIsCarnivorous,$dinasour->isCarnivorous());
    }

    public function getSpecificationTests()
    {
        // specification, is large, is carnivorous
        ['large carnevorous dinosaur', true, true];
        ['get mi all the cookies', false, false];
        ['large herbivore', true, false];
    }

}