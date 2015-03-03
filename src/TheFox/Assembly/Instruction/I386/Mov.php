<?php

namespace TheFox\Assembly\Instruction\I386;

use TheFox\Utilities\Num;
use TheFox\Assembly\Instruction\X86\Mov as X86Mov;

class Mov extends X86Mov{
	
	public function __construct($src, $dst){
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
					$pre = pack('H*', '66');
					break;
			}
			
			$instr = new X86Mov($src, $dst);
			$this->setOpcode($pre.$instr->assemble());
		}
		elseif(is_numeric($src) && is_string($dst)
			&& strlen($dst) == 3){
			$mask = 0xffffffff;
			$base = 0xB8;
			$len = 4;
			
			switch($dst[1]){
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
			
			$pre = '';
			switch($dst){
				case 'ax':
				case 'cx':
				case 'dx':
				case 'bx':
					$pre = pack('H*', '66');
					break;
			}
			
			$instr = new X86Mov($src, $dst);
			$this->setOpcode($pre.$instr->assemble());
		}
		elseif(is_string($src) && is_string($dst)
			&& strlen($src) == 3 && strlen($dst) == 3){
			
			if($this->isValidRegisterSize($src, $dst)){
				$src = $src[1].$src[2];
				$dst = $dst[1].$dst[2];
				
				$instr = new X86Mov($src, $dst);
				$this->setOpcode($instr->assemble());
			}
		}
	}
	
	public function isValidRegisterSize($src, $dst){
		$rv = false;
		$func = __FUNCTION__;
		
		$srcLen = strlen($src);
		$dstLen = strlen($dst);
		
		if($srcLen == 2 && $dstLen == 2){
			$rv = parent::$func($src, $dst);
		}
		elseif($srcLen == 3 && $dstLen == 3){
			if($src[0] == $dst[0]){
				$src = $src[1].$src[2];
				$dst = $dst[1].$dst[2];
				$rv = parent::$func($src, $dst);
			}
		}
		
		return $rv;
	}
	
}
