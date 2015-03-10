<?php

// http://www.mathemainzel.info/files/x86asmref.html#push

namespace TheFox\Assembly\Instruction\X86;

class Push extends Instruction{
	
	public function __construct($register){
		if($register){
			$register = strtolower($register);
			if($register[1] == 'x'){
				$base = 0x50;
				switch($register[0]){
					/*case 'a':
						$base += 0;
						break;*/
					case 'c':
						$base++;
						break;
					case 'd':
						$base += 2;
						break;
					case 'b':
						$base += 3;
						break;
				}
				$this->setOpcode(pack('H*', dechex($base)));
			}
		}
	}
	
}
