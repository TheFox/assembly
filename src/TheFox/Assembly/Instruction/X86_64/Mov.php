<?php

namespace TheFox\Assembly\Instruction\X86_64;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\X86\Mov as X86Mov;
use TheFox\Assembly\Instruction\I386\Mov as I386Mov;

class Mov extends I386Mov{
	
	public function __construct($src, $dst){
		$this->src = strtolower($src);
		$this->dst = strtolower($dst);
		
		$lenSrc = strlen($this->src);
		$isNumSrc = is_numeric($this->src);
		$isStrSrc = is_string($this->src);
		
		$lenDst = strlen($this->dst);
		$isStrDst = is_string($this->dst);
		
		if($isNumSrc && $isStrDst && $lenDst == 2){
			
			$pre = '';
			/*switch($this->dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					$pre = pack('H*', '66');
					break;
			}*/
			
			$instr = new I386Mov($this->src, $this->dst);
			$this->setOpcode($instr->assemble());
			$this->setLen($instr->getLen());
		}
		elseif($isNumSrc && $isStrDst && $lenDst == 3){
			$base = 0;
			
			#print "\n\nx64: ".dechex($this->src).", $dst\n";
			
			switch($dst[0]){
				case 'e':
					#print "\t 32 bit\n";
					$this->src &= 0xffffffff;
					$base = 0xB8;
					
					$this->src = Num::be2le($this->src, 4);
					$this->src = dechex($this->src);
					$lenSrc = strlen($this->src);
					if($lenSrc < 8){
						$this->src = str_repeat('0', 8 - $lenSrc).$this->src;
					}
					#print "\t src: ".$this->src."\n";
					
					break;
				case 'r':	
					
					
					$srcHigh = ($this->src >> 32) & 0xffffffff;
					$srcLow = $this->src & 0xffffffff;
					
					#print "\t 64 bit h=".dechex($srcHigh)." l=".dechex($srcLow)."\n";
					
					if($this->src > 0x7fffffff | $srcHigh){
						#print "\t 64 bit: 64\n";
						
						$base = 0x48B8;
						$this->src = Num::be2le($this->src, 8);
						$this->src = dechex($this->src);
						$lenSrc = strlen($this->src);
						if($lenSrc < 16){
							$this->src = str_repeat('0', 16 - $lenSrc).$this->src;
						}
					}
					else{
						#print "\t 64 bit: 32\n";
						
						$base = 0x48C7C0;
						$this->src = $srcLow;
						
						#print "\t src: ".dechex($this->src)."\n";
						$this->src = Num::be2le($this->src, 4);
						$this->src = dechex($this->src);
						$lenSrc = strlen($this->src);
						if($lenSrc < 8){
							$this->src = str_repeat('0', 8 - $lenSrc).$this->src;
						}
						
						#print "\t 64 bit: ".$this->src."\n";
					}
					
					break;
			}
			switch($dst[1]){
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
			
			$opcode = dechex($base).$this->src;
			$opcodeLen = strlen($opcode);
			
			$this->setOpcode(pack('H*', $opcode));
			$this->setLen($opcodeLen / 2);
		}
		elseif($isStrSrc && $isStrDst && $lenSrc == 2 && $lenDst == 2){
			
			$pre = '';
			/*switch($this->dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					$pre = pack('H*', '66');
					break;
			}*/
			
			$instr = new I386Mov($this->src, $this->dst);
			$this->setOpcode($instr->assemble());
			$this->setLen($instr->getLen());
		}
		elseif($isStrSrc && $isStrDst && $lenSrc == 3 && $lenDst == 3){
			
			if($this->isValidRegisterSize($src, $dst)){
				$pre = '';
				$preLen = 0;
				
				switch($this->src[0]){
					/*case 'e':
						break;*/
					case 'r':
						$pre = pack('H*', '48');
						$preLen++;
						break;
				}
				
				$tSrc = $this->src;
				$tDst = $this->dst;
				
				$tSrc = $tSrc[1].$tSrc[2];
				$tDst = $tDst[1].$tDst[2];
				
				$instr = new X86Mov($tSrc, $tDst);
				$this->setOpcode($pre.$instr->assemble());
				$this->setLen($instr->getLen() + $preLen);
			}
		}
	}
	
}
