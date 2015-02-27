<?php

// http://www.mathemainzel.info/files/x86asmref.html#pop

namespace TheFox\Assembly\Instruction\X86;

class Pop extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		#$this->setOpcode(pack('H*', 'C3'));
		switch($register){
			case 'ax': $this->setOpcode(pack('H*', '58')); break;
			case 'cx': $this->setOpcode(pack('H*', '59')); break;
			case 'dx': $this->setOpcode(pack('H*', '5A')); break;
			case 'bx': $this->setOpcode(pack('H*', '5B')); break;
		}
	}
	
}
