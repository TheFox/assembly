<?php

// http://www.mathemainzel.info/files/x86asmref.html#mov

namespace TheFox\Assembly\Instruction\X86;

use TheFox\Utilities\Num;

class Mov extends Instruction{
	
	public function __construct($src, $dst){
		$src = strtolower($src);
		$dst = strtolower($dst);
		
		if(is_numeric($src) && is_string($dst)
			&& strlen($dst) == 2){
			$mask = 0;
			$base = 0xB0;
			$len = 1;
			
			switch($dst[1]){
				case 'l':
					$mask = 0xff;
					$base += 0;
					break;
				case 'h':
					$mask = 0xff;
					$base += 4;
					break;
				case 'x':
					$mask = 0xffff;
					$base += 8;
					$len = 2;
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
			
			$src &= $mask;
			$src = Num::be2le($src, $len);
			
			$base <<= $len * 8;
			$opcode = dechex($base | $src);
			
			$this->setOpcode(pack('H*', $opcode));
		}
		elseif(is_string($src) && is_string($dst)
			&& strlen($src) == 2 && strlen($dst) == 2){
			
			if($this->isValidRegisterSize($src, $dst)){
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
	
	public function isValidRegisterSize($src, $dst){
		$rv = false;
		
		if($src[1] == 'x' && $dst[1] == 'x'){
			$rv = true;
		}
		elseif(($src[1] == 'l' || $src[1] == 'h')
			&& ($dst[1] == 'l' || $dst[1] == 'h')){
			$rv = true;
		}
		
		return $rv;
	}
	
}
