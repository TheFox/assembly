<?php

// http://www.mathemainzel.info/files/x86asmref.html#mov

namespace TheFox\Assembly\Instruction\X86;

class Mov extends Instruction{
	
	public function __construct($src, $dst){
		$src = strtolower($src);
		$dst = strtolower($dst);
		
		if(is_numeric($src) && is_string($dst)){
			$mask = 0;
			$opcode = '';
			
			if(strlen($dst) == 2){
				$opcode = 'B';
				$base = 0;
				
				switch($dst[1]){
					case 'l':
						$mask = 0xff;
						$base = 0;
						break;
					case 'h':
						$mask = 0xff;
						$base = 4;
						break;
					case 'x':
						$mask = 0xffff;
						$base = 8;
						break;
				}
				switch($dst[0]){
					case 'a':
						$base += 0;
						break;
					case 'c':
						$base += 1;
						break;
					case 'd':
						$base += 2;
						break;
					case 'b':
						$base += 3;
						break;
				}
				
				$opcode .= dechex($base);
			}
			
			if($mask && $opcode){
				$src &= $mask;
				$len = log($mask + 1, 2) / 4;
				
				$srcOpcode = unpack('H*', pack('v', $src));
				$srcOpcode = $srcOpcode[1];
				$srcOpcode = substr($srcOpcode, 0, $len);
				
				$this->setOpcode(pack('H*', $opcode.$srcOpcode));
			}
		}
		elseif(is_string($src) && is_string($dst)){
			$base = 0x8800;
			switch($src[1]){
				case 'x':
					$base += 0x100;
				case 'l':
					$base += 0xc0;
					break;
				case 'h':
					$base += 0xe0;
					break;
			}
			switch($src[0]){
				case 'a':
					$base += 0;
					break;
				case 'c':
					$base += 8;
					break;
				case 'd':
					$base += 0x10;
					break;
				case 'b':
					$base += 0x18;
					break;
			}
			switch($dst[1]){
				case 'l':
					$base += 0;
					break;
				case 'h':
					$base += 4;
					break;
			}
			switch($dst[0]){
				case 'a':
					$base += 0;
					break;
				case 'c':
					$base += 1;
					break;
				case 'd':
					$base += 2;
					break;
				case 'b':
					$base += 3;
					break;
			}
			
			$opcode = dechex($base);
			$this->setOpcode(pack('H*', $opcode));
		}
	}
	
}
