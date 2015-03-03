<?php

namespace TheFox\Assembly\Instruction\X86_64;

use UnexpectedValueException;

use TheFox\Assembly\Instruction\I386\Pop as I386Pop;

class Pop extends I386Pop{
	
	public function __construct($register){
		$register = strtolower($register);
		
		switch($register){
			case 'rax':
				$register = 'eax';
				break;
			
			case 'rcx':
				$register = 'ecx';
				break;
			
			case 'rdx':
				$register = 'edx';
				break;
			
			case 'rbx':
				$register = 'ebx';
				break;
			
			case 'eax':
			case 'ecx':
			case 'edx':
			case 'ebx':
				throw new UnexpectedValueException('exx registered not allowed in X86_64.', 1);
				break;
		}
		
		$instr = new I386Pop($register);
		$this->setOpcode($instr->assemble());
	}
	
}
