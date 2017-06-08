<?php

namespace TheFox\Test;

use PHPUnit\Framework\TestCase;
use TheFox\Assembly\Instruction;

class BasicTestCase extends TestCase
{
    public function basicTest(Instruction $instr, string $expected, int $len)
    {
        $opcode = unpack('H*', $instr->assemble());
        $opcode = $opcode[1];

        $this->assertEquals($expected, $opcode);
        $this->assertEquals($len, $instr->getLen());
    }
}
