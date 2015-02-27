<?php

// http://www.mathemainzel.info/files/x86asmref.html#push

namespace TheFox\Assembly\Instruction\X86;

class Push extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		#$this->setOpcode(pack('H*', 'C3'));
		switch($register){
			case 'ax':
				$this->setOpcode(pack('H*', '50'));
				break;
			case 'cx':
				$this->setOpcode(pack('H*', '51'));
				break;
			case 'dx':
				$this->setOpcode(pack('H*', '52'));
				break;
			case 'bx':
				$this->setOpcode(pack('H*', '53'));
				break;
		}
	}
	
}
