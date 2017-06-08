<?php

// http://www.mathemainzel.info/files/x86asmref.html#pop

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Assembly\Instruction;

class Pop extends Instruction
{
    public function __construct($register)
    {
        if (!$register) {
            return;
        }
        $register = strtolower($register);
        if ($register[1] == 'x') {
            $base = 0x58;
            switch ($register[0]) {
                /*case 'a':
                    $base += 0;
                    break;*/
                case 'c':
                    $base++;
                    break;
                case 'd':
                    $base += 2;
                    break;
                case 'b':
                    $base += 3;
                    break;
            }

            $opcode = dechex($base);
            $opcodeLen = strlen($opcode);

            $this->setOpcode(pack('H*', $opcode));

            parent::__construct($opcodeLen / 2);
        }
    }
}
