<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Pop as X86Pop;

class Pop extends X86Pop{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$pre = '';
		
		$lenRegister = strlen($register);
		if($lenRegister == 2){
			$pre = pack('H*', '66');
		}
		elseif($lenRegister == 3 && $register[0] == 'e'){
			$register = $register[1].$register[2];
		}
		
		$instr = new X86Pop($register);
		$this->setOpcode($pre.$instr->assemble());
	}
	
}
