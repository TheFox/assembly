<?php

// http://www.mathemainzel.info/files/x86asmref.html#nop

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Assembly\Instruction;

class Nop extends Instruction
{
    public function __construct()
    {
        $this->setOpcode(pack('H*', '90'));
        // $this->setLen(1);
        parent::__construct(1);
    }
}
