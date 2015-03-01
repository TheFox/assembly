<?php

// http://www.mathemainzel.info/files/x86asmref.html#pop

namespace TheFox\Assembly\Instruction\X86;

class Pop extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		$opcode = '';
		switch($register){
			case 'ax':
				$opcode = '58';
				break;
			case 'cx':
				$opcode = '59';
				break;
			case 'dx':
				$opcode = '5A';
				break;
			case 'bx':
				$opcode = '5B';
				break;
		}
		if($opcode){
			$this->setOpcode(pack('H*', $opcode));
		}
	}
	
}
