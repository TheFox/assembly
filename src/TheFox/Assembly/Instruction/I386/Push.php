<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Push as X86Push;

class Push extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		#$this->setOpcode(pack('H*', 'C3'));
		
		$preC = pack('H*', '66');
		$pre = '';
		
		switch($register){
			case 'ax':
				$pre = $preC;
			case 'eax':
				$push = new X86Push('ax');
				$this->setOpcode($pre.$push->assemble());
				break;
			
			case 'cx':
				$pre = $preC;
			case 'ecx':
				$push = new X86Push('cx');
				$this->setOpcode($pre.$push->assemble());
				break;
			
			case 'dx':
				$pre = $preC;
			case 'edx':
				$push = new X86Push('dx');
				$this->setOpcode($pre.$push->assemble());
				break;
			
			case 'bx':
				$pre = $preC;
			case 'ebx':
				$push = new X86Push('bx');
				$this->setOpcode($pre.$push->assemble());
				break;
		}
	}
	
}
