<?php

namespace TheFox\Test;

use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function testNum()
    {
        $this->assertTrue(is_numeric(0xff));

        $this->assertEquals('AB', pack('v', 0x4241));
        $this->assertEquals('CD', pack('n', 0x4344));
    }
}
