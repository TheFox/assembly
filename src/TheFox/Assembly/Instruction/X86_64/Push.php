<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;
use TheFox\Assembly\Instruction\I386\Push as I386Push;

class Push extends I386Push
{
    public function __construct($register)
    {
        $register = strtolower($register);

        $lenRegister = strlen($register);
        if ($lenRegister == 3) {
            switch ($register[0]) {
                case 'e':
                    throw new UnexpectedValueException('exx registers not allowed in X86_64 for this instruction.', 1);
                case 'r':
                    $register = 'e' . $register[1] . $register[2];
                    break;
            }
        }

        // $instr = new I386Push($register);
        // $this->setOpcode($instr->assemble());
        // $this->setLen($instr->getLen());
        parent::__construct($register);
    }
}
