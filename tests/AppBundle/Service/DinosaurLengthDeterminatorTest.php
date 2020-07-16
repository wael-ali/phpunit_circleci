<?php


namespace Tests\AppBundle\Service;



use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;

class DinosaurLengthDeterminatorTest extends TestCase
{
    /**
     * @dataProvider getSpecLengthTests
     */
    public function testItReturnsCorrectLengthRange($spec, $minExpectdSize, $maxExpectedSize)
    {
        $determinator = new DinosaurLengthDeterminator();

        $actualSize = $determinator->getLengthFromSpecification($spec);
        $this->assertGreaterThanOrEqual($minExpectdSize, $actualSize);
        $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
    }

    public function getSpecLengthTests()
    {
        return [
            // specification, minsize, maxsize
            ['large carnivorous dinosaur', Dinosaur::LARGE, Dinosaur::HUGE - 1],
            'default values' => ['get me all the cookies', 0, Dinosaur::LARGE -1],
            ['large herbivore', Dinosaur::LARGE , Dinosaur::HUGE - 1],
            ['huge herbivore', Dinosaur::HUGE, 100],
            ['huge dinosaur', Dinosaur::HUGE, 100],
            ['huge dino', Dinosaur::HUGE, 100],
            ['huge', Dinosaur::HUGE, 100],
            ['OMG', Dinosaur::HUGE, 100],
        ];
    }
}