<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;

use TheFox\Assembly\Instruction\I386\Pop as I386Pop;

class Pop extends I386Pop{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
			case 'rax':
				$instr = new I386Pop('eax');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'cx':
				$pre = $preC;
			case 'rcx':
				$instr = new I386Pop('ecx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'dx':
				$pre = $preC;
			case 'rdx':
				$instr = new I386Pop('edx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'bx':
				$pre = $preC;
			case 'rbx':
				$instr = new I386Pop('ebx');
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
