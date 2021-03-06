<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Pop as X86Pop;

class Pop extends X86Pop
{
    /**
     * Pop constructor.
     * @param string $register
     */
    public function __construct(string $register)
    {
        $register = strtolower($register);

        $pre = '';
        $preLen = 0;

        $lenRegister = strlen($register);
        if ($lenRegister == 2) {
            $pre = pack('H*', '66');
            $preLen++;
        } elseif ($lenRegister == 3 && $register[0] == 'e') {
            $register = $register[1] . $register[2];
        }

        parent::__construct($register);
        
        $this->setOpcode($pre . $this->assemble());
        $this->setLen($this->getLen() + $preLen);
    }
}
