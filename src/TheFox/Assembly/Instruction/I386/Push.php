<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Push as X86Push;

class Push extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
			case 'eax':
				$instr = new X86Push('ax');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'cx':
				$pre = $preC;
			case 'ecx':
				$instr = new X86Push('cx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'dx':
				$pre = $preC;
			case 'edx':
				$instr = new X86Push('dx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'bx':
				$pre = $preC;
			case 'ebx':
				$instr = new X86Push('bx');
				$this->setOpcode($pre.$instr->assemble());
				break;
		}
	}
	
}
