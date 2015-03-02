<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;

use TheFox\Assembly\Instruction\I386\Push as I386Push;

class Push extends I386Push{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
			case 'rax':
				$instr = new I386Push('eax');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'cx':
				$pre = $preC;
			case 'rcx':
				$instr = new I386Push('ecx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'dx':
				$pre = $preC;
			case 'rdx':
				$instr = new I386Push('edx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'bx':
				$pre = $preC;
			case 'rbx':
				$instr = new I386Push('ebx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'eax':
			case 'ecx':
			case 'edx':
			case 'ebx':
				throw new UnexpectedValueException('exx registered not allowed in X86_64.', 1);
				break;
		}
	}
	
}
