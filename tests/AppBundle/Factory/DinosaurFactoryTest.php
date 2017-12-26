<?php

namespace Tests\AppBundle\Factory;

use PHPUnit\Framework\TestCase;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Entity\Dinosaur;

class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinosaurFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new DinosaurFactory();
    }

    public function testIsGrowsAVelociraptor()
    {
        $dinosaur = $this->factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dinosaur);
        $this->assertInternalType('string', $dinosaur->getGenus());
        $this->assertSame('Velociraptor', $dinosaur->getGenus());
        $this->assertSame(5, $dinosaur->getLength());
    }

    public function testItGrowsATriceratops()
    {
        $this->markTestIncomplete('Waiting for genlab');
    }

    public function testItGrowsABabyVelociraptor()
    {
        if (!class_exists('nanny')) {
            $this->markTestSkipped('There is nobody to check the babysaur');
        }

        $dinosaur = $this->factory->growVelociraptor(1);
        $this->assertSame(1, $dinosaur->getLength());

    }

    /**
     * @dataProvider getSpecificationTests
     */
    public function testItGrowsADinosaurFromASpecification(string $spec, bool $expectedIsLarge, bool $expectedIsCarnivorous)
    {
        $dinosaur = $this->factory->growFromSpecification($spec);

        if($expectedIsLarge) {
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());
        } else {
            $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
        }

        $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorus(), 'Diets do not match');

    }

    public function getSpecificationTests()
    {
        return [
            // specification, is large, is carnivorous
            ['large carnivorous dinosaur', true, true],
            'default response' => ['give me all the cookies!!!', false, false],
            ['large herbivore', true, false],
        ];
    }

    /**
     * @dataProvider getHugeDinosaurSpecTests
     */
    public function testItGrowsAHugeDinosaur(string $specification)
    {
        $dinosaur = $this->factory->growFromSpecification($specification);
        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dinosaur->getLength());
    }

    public function getHugeDinosaurSpecTests()
    {
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['screem'],
        ];
    }
}