<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Pop as X86Pop;

class Pop extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
			case 'eax':
				$instr = new X86Pop('ax');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'cx':
				$pre = $preC;
			case 'ecx':
				$instr = new X86Pop('cx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'dx':
				$pre = $preC;
			case 'edx':
				$instr = new X86Pop('dx');
				$this->setOpcode($pre.$instr->assemble());
				break;
			
			case 'bx':
				$pre = $preC;
			case 'ebx':
				$instr = new X86Pop('bx');
				$this->setOpcode($pre.$instr->assemble());
				break;
		}
	}
	
}
