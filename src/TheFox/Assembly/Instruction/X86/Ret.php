<?php

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Assembly\Instruction;

class Ret extends Instruction
{
    public function __construct()
    {
        $this->setOpcode(pack('H*', 'C3'));

        parent::__construct(1); // len 1
    }
}
