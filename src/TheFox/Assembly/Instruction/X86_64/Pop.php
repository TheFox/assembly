<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;
use TheFox\Assembly\Instruction\I386\Pop as I386Pop;

class Pop extends I386Pop
{
    /**
     * Pop constructor.
     * @param string $register
     */
    public function __construct(string $register)
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
        parent::__construct($register);
    }
}
