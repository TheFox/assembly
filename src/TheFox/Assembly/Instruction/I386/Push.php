<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Push as X86Push;

class Push extends X86Push{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
				break;
			case 'eax':
				$register = 'ax';
				break;
			
			case 'cx':
				$pre = $preC;
				break;
			case 'ecx':
				$register = 'cx';
				break;
			
			case 'dx':
				$pre = $preC;
				break;
			case 'edx':
				$register = 'dx';
				break;
			
			case 'bx':
				$pre = $preC;
				break;
			case 'ebx':
				$register = 'bx';
				break;
		}
		
		$instr = new X86Push($register);
		$this->setOpcode($pre.$instr->assemble());
	}
	
}
