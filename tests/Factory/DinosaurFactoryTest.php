<?php


namespace Tests\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;

class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinosaurFactory
     */
    private $factory;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $lengthDeterminator;

    public function setUp()
    {
        $this->lengthDeterminator = $this->createMock(DinosaurLengthDeterminator::class);
        $this->factory = new DinosaurFactory($this->lengthDeterminator);
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
    public function testItGrowsADinosaurFromSpecification(string $spec, bool $expectedIsCarnivorous)
    {
        $this->lengthDeterminator->method('getLengthFromSpecification')
        ->willReturn(20);
        $dinasour = $this->factory->growFromSpecification($spec);
        $this->assertSame($expectedIsCarnivorous,$dinasour->isCarnivorous());
        $this->assertSame(20,$dinasour->getLength());
    }

    public function getSpecificationTests()
    {
        return [
            // specification, is large, is carnivorous
            ['large carnivorous dinosaur',  true],
            'default values' => ['get me all the cookies', false],
            ['large herbivore',  false]
        ];
    }
}