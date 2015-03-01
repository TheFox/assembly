<?php

// http://www.mathemainzel.info/files/x86asmref.html#push

namespace TheFox\Assembly\Instruction\X86;

class Push extends Instruction{
	
	public function __construct($register){
		$register = strtolower($register);
		$opcode = '';
		switch($register){
			case 'ax':
				$opcode = '50';
				break;
			case 'cx':
				$opcode = '51';
				break;
			case 'dx':
				$opcode = '52';
				break;
			case 'bx':
				$opcode = '53';
				break;
		}
		if($opcode){
			$this->setOpcode(pack('H*', $opcode));
		}
	}
	
}
