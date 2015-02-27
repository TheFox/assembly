<?php

namespace TheFox\Assembly\Instruction\X86;

class Ret extends Instruction{
	
	public function __construct(){
		$this->setOpcode(pack('H*', 'C3'));
	}
	
}
