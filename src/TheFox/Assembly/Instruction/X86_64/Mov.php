<?php

namespace TheFox\Assembly\Instruction\X86_64;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\X86\Mov as X86Mov;
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
		$this->src = strtolower($src);
		$this->dst = strtolower($dst);
		
		$lenSrc = strlen($this->src);
		$isNumSrc = is_numeric($this->src);
		$isStrSrc = is_string($this->src);
		
		$lenDst = strlen($this->dst);
		$isStrDst = is_string($this->dst);
		
		if($isNumSrc && $isStrDst && $lenDst == 2){
			
			$pre = '';
			switch($this->dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					#$pre = pack('H*', '66');
					break;
			}
			
			$instr = new I386Mov($this->src, $this->dst);
			#$this->setOpcode(pack('H*', '66').$instr->assemble());
			$this->setOpcode($pre.$instr->assemble());
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
					
					/*if($this->src <= 0x7fffffff){
					#if((($this->src >> 32) & 0xffffffff) == 0){
					#if(($this->src & 0x7fffffff) != 0){
					#if($srcHigh == 0){
					}
					else{
					}*/
					
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
			$opcode = dechex($base).$this->src;
			
			#print "\t opcode: ".$opcode."\n";
			$this->setOpcode(pack('H*', $opcode));
		}
		elseif($isStrSrc && $isStrDst && $lenSrc == 2 && $lenDst == 2){
			
			$pre = '';
			switch($this->dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					#$pre = pack('H*', '66');
					break;
			}
			
			$instr = new I386Mov($this->src, $this->dst);
			$this->setOpcode($pre.$instr->assemble());
		}
		elseif($isStrSrc && $isStrDst && $lenSrc == 3 && $lenDst == 3){
			
			if($this->isValidRegisterSize($src, $dst)){
				$pre = '';
				
				switch($this->src[0]){
					case 'e':
						
						break;
					case 'r':
						$pre = pack('H*', '48');
						break;
				}
				
				$tSrc = $this->src;
				$tDst = $this->dst;
				
				$tSrc = $tSrc[1].$tSrc[2];
				$tDst = $tDst[1].$tDst[2];
				
				$instr = new X86Mov($tSrc, $tDst);
				$this->setOpcode($pre.$instr->assemble());
			}
		}
	}
	
}
