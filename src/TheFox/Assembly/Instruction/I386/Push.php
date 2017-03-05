<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Assembly\Instruction\X86\Push as X86Push;

class Push extends X86Push{
	
	public function __construct($register){
		$register = strtolower($register);
		
		$pre = '';
		$preLen = 0;
		
		$lenRegister = strlen($register);
		if($lenRegister == 2){
			$pre = pack('H*', '66');
			$preLen++;
		}
		elseif($lenRegister == 3 && $register[0] == 'e'){
			$register = $register[1].$register[2];
		}
		
		// $instr = new X86Push($register);
		// $this->setOpcode($pre.$instr->assemble());
		// $this->setLen($instr->getLen() + $preLen);
		parent::__construct($register);
		$this->setOpcode($pre.$this->assemble());
		$this->setLen($this->getLen() + $preLen);
	}
	
}
