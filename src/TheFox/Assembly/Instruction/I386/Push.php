<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Push as X86Push;

class Push extends X86Push{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$pre = '';
		
		/*$preC = pack('H*', '66');
		
		
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
		}*/
		$preLen = 0;
		
		$lenRegister = strlen($register);
		if($lenRegister == 2){
			$pre = pack('H*', '66');
			$preLen++;
		}
		elseif($lenRegister == 3 && $register[0] == 'e'){
			$register = $register[1].$register[2];
		}
		
		$instr = new X86Push($register);
		$this->setOpcode($pre.$instr->assemble());
		$this->setLen($instr->getLen() + $preLen);
	}
	
}
