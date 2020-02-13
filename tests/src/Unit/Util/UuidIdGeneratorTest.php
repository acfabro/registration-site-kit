<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\Util;

use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;
use Orchestra\Testbench\TestCase;

class UuidIdGeneratorTest extends TestCase
{
    public function testGenerateNotEmpty()
    {
        $x = new UuidIdGenerator();
        $id = $x->generate();
        $this->assertNotEmpty($id, "Generate: {$id}");
    }

    /**
     * Test for 100 iterations that each generated iten is unique
     */
    public function testGeneratedNumberUnique()
    {
        $gen = new UuidIdGenerator();
        $prev = $gen->generate();

        // test for 100 iterations
        for ($i = 0; $i < 100; $i++) {
            $next = $gen->generate();

            $this->assertNotEquals($prev, $next);
            $prev = $next;
        }
    }
}
