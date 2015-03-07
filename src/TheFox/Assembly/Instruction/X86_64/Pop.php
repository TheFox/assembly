<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;

use TheFox\Assembly\Instruction\I386\Pop as I386Pop;

class Pop extends I386Pop{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$lenRegister = strlen($register);
		if($lenRegister == 3){
			switch($register[0]){
				case 'e':
					throw new UnexpectedValueException('exx registered not allowed in X86_64.', 1);
				case 'r':
					$register = 'e'.$register[1].$register[2];
					break;
			}
		}
		
		$instr = new I386Pop($register);
		$this->setOpcode($instr->assemble());
	}
	
}
