<?php

namespace Tests\AppBundle\Factory;

use PHPUnit\Framework\TestCase;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Entity\Dinosaur;

class DinosaurFactoryTest extends TestCase
{
    public function testIsGrownAsVelociraptor()
    {
        $factory = new DinosaurFactory();
        $dinosaur = $factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dinosaur);
        $this->assertInternalType('string', $dinosaur->getGenus());
        $this->assertSame('Velociraptor', $dinosaur->getGenus());
        $this->assertSame(5, $dinosaur->getLength());
    }
}