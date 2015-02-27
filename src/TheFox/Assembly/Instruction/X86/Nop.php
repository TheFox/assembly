<?php

// http://www.mathemainzel.info/files/x86asmref.html#nop

namespace TheFox\Assembly\Instruction\X86;

class Nop extends Instruction{
	
	public function __construct(){
		$this->setOpcode(pack('H*', '90'));
	}
	
}
