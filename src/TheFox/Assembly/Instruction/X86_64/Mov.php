<?php

namespace TheFox\Assembly\Instruction\X86_64;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\I386\Mov as I386Mov;

class Mov extends I386Mov{
	
	public function __construct($src, $dst){
		/*$src64 = false;
		$srcHigh = null;
		$srcLow = null;
		if(is_array($src)){
			$src64 = true;
			list($srcHigh, $srcLow) = $src;
		}
		*/
		$src = strtolower($src);
		$dst = strtolower($dst);
		
		if(is_numeric($src) && is_string($dst)
			&& strlen($dst) == 2){
			
			$pre = '';
			switch($dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					#$pre = pack('H*', '66');
					break;
			}
			
			$instr = new I386Mov($src, $dst);
			#$this->setOpcode(pack('H*', '66').$instr->assemble());
			$this->setOpcode($pre.$instr->assemble());
		}
		elseif(is_numeric($src) && is_string($dst)
			&& strlen($dst) == 3){
			$base = 0;
			
			print "\n\nx64: ".dechex($src).", $dst\n";
			
			switch($dst[0]){
				case 'e':
					#print "\t 32 bit\n";
					#$mask = ;
					$src &= 0xffffffff;
					$base = 0xB8;
					
					#print "\t src: ".dechex($src)."\n";
					$src = Num::be2le($src, 4);
					$src = dechex($src);
					$srcLen = strlen($src);
					if($srcLen < 8){
						$src = str_repeat('0', 8 - $srcLen).$src;
					}
					#$src = Num::be2leStr($src, 4);
					#print "\t src: ".$src."\n";
					
					break;
				case 'r':
					print "\t 64 bit\n";
					/*$mask = 0xffffffffffffffff;
					#$mask = 0x123456789abcdefe;
					#$base = 0x48C7C0;
					
					if($src & 0x8000000000000000){
						print "\t > 32bit\n";
						$base = 0x48B8;
					}
					*/
					
					if($src <= 0x7fffffff){
						print "\t 64 bit: 32\n";
						
						$src &= 0xffffffff;
						$base = 0x48C7C0;
						
						#print "\t src: ".dechex($src)."\n";
						$src = Num::be2le($src, 4);
						$src = dechex($src);
						$srcLen = strlen($src);
						if($srcLen < 8){
							$src = str_repeat('0', 8 - $srcLen).$src;
						}
					}
					else{
						print "\t 64 bit: 64\n";
						
						$base = 0x48B8;
						$src = Num::be2le($src, 8);
						$src = dechex($src);
						$srcLen = strlen($src);
						if($srcLen < 16){
							$src = str_repeat('0', 16 - $srcLen).$src;
						}
						
					}
					
					break;
			}
			switch($dst[1]){
				case 'a':
					#print "\t x64: a\n";
					$base += 0;
					break;
				case 'c':
					#print "\t x64: c\n";
					$base += 1;
					break;
				case 'd':
					#print "\t x64: d\n";
					$base += 2;
					break;
				case 'b':
					#print "\t x64: b\n";
					$base += 3;
					break;
			}
			
			#$base <<= $len * 8;
			#print "\t base: ".$base."\n";
			$opcode = dechex($base).$src;
			
			print "\t opcode: ".$opcode."\n";
			$this->setOpcode(pack('H*', $opcode));
			
		}
		elseif(is_string($src) && is_string($dst)
			&& strlen($src) == 2 && strlen($dst) == 2){
			
			$pre = '';
			switch($dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					#$pre = pack('H*', '66');
					break;
			}
			
			$instr = new I386Mov($src, $dst);
			#$this->setOpcode(pack('H*', '66').$instr->assemble());
			$this->setOpcode($pre.$instr->assemble());
		}
		elseif(is_string($src) && is_string($dst)
			&& strlen($src) == 3 && strlen($dst) == 3){
			
			if($this->isValidRegisterSize($src, $dst)){
				$src = $src[1].$src[2];
				$dst = $dst[1].$dst[2];
				
				$instr = new I386Mov($src, $dst);
				$this->setOpcode($instr->assemble());
			}
		}
	}
	
}
